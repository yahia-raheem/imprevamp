export default {
  whitelist: [
    "woocommerce",
    "add_payment_method",
    "related",
    "button",
    "variable_product_options",
    "path",
    "leaving",
    "entering",
    "active",
    "is-active",
    "is-visible",
    "wpcf7-not-valid-tip",
    "iti__flag-container",
    "alert-success",
  ],
  whitelistPatterns: [
    /^woocommerce-/,
    /^wc-/,
    /^wc_ /,
    /^product-/,
    /^columns-/,
    /^select2-/,
    /^price_slider/,
    /^pagination/,
    /^path/,
    /^dropdown/,
    /^splide/,
    /^wpcf7/,
  ],
};
