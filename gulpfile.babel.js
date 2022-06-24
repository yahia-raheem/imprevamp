import { src, dest, watch, series, parallel } from "gulp";
import yargs from "yargs";
import sass from "gulp-sass";
import cleanCss from "gulp-clean-css";
import gulpif from "gulp-if";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import del from "del";
import webpack from "webpack-stream";
import named from "vinyl-named";
import zip from "gulp-zip";
import info from "./package.json";
import replace from "gulp-replace";
import cssnano from "cssnano";
import Fiber from "fibers";
import purgecss from "gulp-purgecss";
import safelist from "./purgecss.safelist";
import ignoreList from "./critical.safelist";
import sherpa from "style-sherpa";
import fs from "fs";
import yaml from "js-yaml";
import scrape from "website-scraper";
import rtlcss from "rtlcss";
import rename from "gulp-rename";

const critical = require("critical").stream;

const PRODUCTION = yargs.argv.prod;
sass.compiler = require("sass");

// Load settings from settings.yml
const {
  CRITICALSIZES,
  SCRAPPEREXTRACT,
  SCRAPPERLINK,
  GENCRITICAL,
  BUILDBUNDLE,
} = loadConfig();

function loadConfig() {
  let ymlFile = fs.readFileSync("config.yml", "utf8");
  return yaml.load(ymlFile);
}

export const extractHtml = (c) => {
  return scrape(
    {
      urls: [SCRAPPERLINK],
      directory: "dist/extracted",
      recursive: true,
      maxRecursiveDepth: 2,
      sources: [{}],
    },
    c
  );
};

export const styles = () => {
  return src(["src/scss/**/*.scss"])
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass({ fiber: Fiber }).on("error", sass.logError))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest("dist/assets/css/"));
};

export const blockStyles = () => {
  return src(["templates/blocks/**/*.scss"])
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass({ fiber: Fiber }).on("error", sass.logError))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest("dist/assets/css/blocks"));
};

export const rtlStyles = () => {
  return src(["dist/assets/css/**/*.css", "!dist/assets/css/**/*-rtl.css"])
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(postcss([rtlcss()]))
    .pipe(
      rename({
        suffix: "-rtl",
      })
    )
    .pipe(dest("dist/assets/css"));
};

export const postStyles = () => {
  return src(["dist/assets/css/**/*.css"])
    .pipe(gulpif(PRODUCTION, cleanCss({ level: 0 })))
    .pipe(
      gulpif(
        PRODUCTION,
        postcss([cssnano({ preset: ["advanced", { reduceIdents: false }] })])
      )
    )
    .pipe(dest("dist/assets/css"));
};

export const stylePurge = () => {
  return src(["dist/assets/css/**/*.css"])
    .pipe(
      gulpif(
        PRODUCTION,
        purgecss({
          content: [
            "dist/**/*.html",
            "dist/assets/js/**/*.js",
            "!dist/styleguide.html",
          ],
          defaultExtractor: (content) =>
            content.match(/[\w-/:\[\]\%]+(?<!:)/g) || [],
          safelist: {
            standard: [...safelist.whitelist],
            deep: [...safelist.whitelistPatterns],
          },
        })
      )
    )
    .pipe(dest("dist/assets/css"));
};

export const scripts = () => {
  return src([
    "src/js/bundle.js",
    "src/js/bundle-rtl.js",
    "src/js/blocks/**/*.js",
    "src/js/pages/**/*.js",
  ])
    .pipe(named())
    .pipe(
      webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: "babel-loader",
                options: {
                  presets: ["@babel/preset-env"],
                },
              },
            },
          ],
        },
        mode: PRODUCTION ? "production" : "development",
        devtool: false,
        output: {
          filename: "[name].js",
        },
        externals: {},
      })
    )
    .pipe(dest("dist/assets/js"));
};

export const copy = () => {
  return src([
    "src/**/*",
    "!src/{js,scss,html, styleguide}",
    "!src/{js,scss,html, styleguide}/**/*",
  ]).pipe(dest("dist"));
};

export const styleGuide = (done) => {
  sherpa(
    "./src/styleguide/index.md",
    {
      output: "./dist/styleguide.html",
      template: "./src/styleguide/template.hbs",
    },
    done
  );
};

export const genCritical = (cb) => {
  return src(["dist/**/*.html", "!dist/styleguide.html", "!dist/**/*-rtl.html"])
    .pipe(
      critical({
        base: "dist/",
        inline: true,
        css: ["dist/assets/css/bundle.css"],
        dimensions: CRITICALSIZES,
        ignore: {
          rule: ignoreList.ignorePatterns,
        },
      })
    )
    .on("error", (err) => {
      console.log(err);
    })
    .pipe(dest("dist"));
};
export const genCriticalRtl = () => {
  return src(["dist/**/*-rtl.html"])
    .pipe(
      critical({
        base: "dist/",
        inline: true,
        css: ["dist/assets/css/bundle-rtl.css"],
        dimensions: CRITICALSIZES,
        ignore: {
          rule: ignoreList.ignorePatterns,
        },
      })
    )
    .on("error", (err) => {
      console.log(err);
    })
    .pipe(dest("dist"));
};

// export const server = (done) => {
//   browser.init({
//     server: {
//       baseDir: "dist",
//       directory: BROWSERSYNC.directory,
//       routes: {
//         "/assets": "assets",
//       },
//     },
//     tunnel: BROWSERSYNC.tunnel,
//     port: 3000,
//   });
//   done();
// };

export const clean = () => del(["dist"]);
export const extractClean = () => del(["dist/extracted"]);

export const compress = () => {
  return src(["dist/**/*"])
    .pipe(
      gulpif(
        (file) => file.relative.split(".").pop() !== "zip",
        replace("imp", info.name)
      )
    )
    .pipe(zip(`${info.name}-${info.version}.zip`))
    .pipe(dest("bundled"));
};

export const watchForChanges = () => {
  watch("src/scss/**/*.scss").on("all", series(styles, rtlStyles));
  watch(["src/**/*", "!src/{js,scss}", "!src/{js,scss}/**/*"]).on("all", copy);
  watch("src/js/**/*.js").on("all", series(scripts, styles));
  watch("src/styleguide/**").on("all", series(styleGuide));
};

const gulpTaskIf = (condition, task) => {
  task = series(task); // make sure we have a function that takes callback as first argument
  return (cb) => {
    if (condition()) {
      task(cb);
    } else {
      cb();
    }
  };
};

export const dev = series(
  clean,
  parallel(styles, blockStyles, copy, scripts),
  rtlStyles,
  styleGuide,
  watchForChanges
);
export const build = series(
  clean,
  gulpTaskIf(() => SCRAPPEREXTRACT, extractHtml),
  scripts,
  parallel(styles, blockStyles, copy),
  rtlStyles,
  postStyles,
  styleGuide,
  stylePurge,
  gulpTaskIf(() => GENCRITICAL, genCritical),
  gulpTaskIf(() => GENCRITICAL, genCriticalRtl),
  gulpTaskIf(() => SCRAPPEREXTRACT, extractClean),
  gulpTaskIf(() => BUILDBUNDLE, compress)
);
export default dev;
