const API = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SndjbTltYVd4bFgzQnJJam94TWpZNU1pd2libUZ0WlNJNkltbHVhWFJwWVd3aUxDSmpiR0Z6Y3lJNklrMWxjbU5vWVc1MEluMC5xYmgxaEJabHViYzlYbkoySHBLT2xyNURmRGpMcXpYUDZrTVBjSFdFMlpzelptQmxCUjNJMFJPeU4tY3JXQlQ3ZE51UGF0NFFNcG5yTXBwdkdSZGI3Zw=='

let COURSE_PRICE = null;
let COURSE_NAME = null;
let COURSE_DATE = null;


async function firstStep () {
    let data = {
        "api_key": API
    }

    let request = await fetch('https://accept.paymob.com/api/auth/tokens', {
        method: 'post',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    })

    let response = await request.json()

    let token = response.token;

    secondStep(token)
}

async function secondStep (token) {

    if(COURSE_PRICE && COURSE_NAME) {
        let data = {
            "auth_token":  token,
            "delivery_needed": "false",
            "amount_cents": COURSE_PRICE * 100,
            "currency": "EGP",
            "items": [],
        }
        let request = await fetch('https://accept.paymob.com/api/ecommerce/orders', {
            method: 'post',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        })
    
        let response = await request.json();;
    
        let id = response.id;
    
        thirdStep(token , id);
    }
}

async function thirdStep (token, id) {

    if(COURSE_PRICE && COURSE_NAME) {
        document.addEventListener( 'wpcf7submit', async function( event ) {
            var inputs = event.detail.inputs;
        
            let data = {
                "auth_token": token,
                "amount_cents": COURSE_PRICE * 100,
                "expiration": 3600, 
                "order_id": id,
                "billing_data": {
                  "apartment": "_", 
                  "email": inputs[4].value, 
                  "floor": "5", 
                  "first_name": inputs[3].value, 
                  "street": "Amman Street", 
                  "building": "37", 
                  "phone_number": inputs[5].value, 
                  "shipping_method": "PKG",
                  "postal_code": "01898", 
                  "city": "Dokki", 
                  "country": inputs[6].value, 
                  "last_name": "_", 
                  "state": "Giza"
                }, 
                "currency": "EGP",
                "integration_id": 21576, //2179836
            }
        
            let request = await fetch('https://accept.paymob.com/api/acceptance/payment_keys', {
                method: 'post',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
        
            let response = await request.json();
        
            let finaltoken = response.token;
        
            cardPayment(finaltoken);
    
        }, false );
    }

    
}

async function cardPayment(finaltoken) {
    var o_url = `https://accept.paymob.com/api/acceptance/iframes/36397?payment_token=${finaltoken}`

    var iframeDev = document.getElementById('accepting-container');

    iframeDev.innerHTML += '<iframe src="' + o_url + '"></iframe>'
}

firstStep();

document.addEventListener( 'DOMContentLoaded', function () {
    const course_data = document.querySelector('.smg-course-data');
    if(course_data && course_data.hasAttribute('data-course-name') && course_data.hasAttribute('data-course-price'))  {
       const course_name = course_data.getAttribute('data-course-name')
       const course_price = course_data.getAttribute('data-course-price')
       const course_date = course_data.getAttribute('data-course-date')

       document.getElementById('courseTitlefield').value = course_name;
       document.getElementById('coursePricefield').value = course_price;

       var select = document.getElementById("courseDatefield");
       var options = course_date;

       const sectors = JSON.parse(options);

        var employees = {
            accounting: []
        };
        
        for(var i in sectors) {    
            var item = sectors[i];   
            employees.accounting.push({ 
                "course_date" : item.course_date,
            });
        }

        for(var i = 0; i < employees.accounting.length; i++) {
            var opt = employees.accounting[i].course_date;
            var el = document.createElement("option");
            el.textContent = opt;
            el.value = opt;
            select.appendChild(el);
        }

       COURSE_PRICE = course_price;
       COURSE_NAME = course_name;
       COURSE_DATE = course_date;
    }

    console.log(COURSE_DATE);
    console.log(COURSE_NAME);
});