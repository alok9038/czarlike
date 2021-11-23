
country : https://czarlike.com/api/countries
method : post


state : https://czarlike.com/api/states
method : post
body{

    city_id : 23,
}

city : https://czarlike.com/api/cities
method : post

body{
    state_id : 2323;
}

login : https://czarlike.com/api/login
method : post;

body{
    email : test@gmail.com
    password : test@123
}

register : https://czarlike.com/api/register
method : post;

body{
    user_name : akon,
    email : akon@gmail.com,
    password : akon@123,
    country_id : 101,
    state_id : 21,
    city_id : 4334,
    phone : 9113751143,
    website : optional
}

// logout logedIn user

logout : https://czarlike.com/api/logout
method : post;


// get categories, subcategories, or child categories

Categories : https://czarlike.com/api/categories
method : post

 
// get featured products

Featured Products : https://czarlike.com/api/featured-products
method : get


// get all active products
Products : https://czarlike.com/api/products
method : get

// deal of the day
Products : https://czarlike.com/api/deals-of-the-day
method : get

// get single product details 
Product : https://czarlike.com/api/product
method : post

body{
    product_id : 232232,
}


{{-- token required --}}

Get wishlist products : https://czarlike.com/api/get-wishlists
mehod : post

Get wishlist products : https://czarlike.com/api/add-to-wishlists
mehod : post;

body{
    product_id : 243,
}

Get wishlist products : https://czarlike.com/api/remove-wishlists
mehod : post;

body{
    wishlist_id : 243,
}

Get wishlist products : https://czarlike.com/api/remove-wishlists
mehod : post;

body{
    wishlist_id : 243,
}

Get cart items : https://czarlike.com/api/get-cart-items
mehod : post;


Add to cart : https://czarlike.com/api/add-to-cart
method : post,

body{
    product_id : 232,
    size_id : 12 , // if product has sizes : required
    color_id : 23 , // if product has colors : required
    variant_price : 233, // as per size or color variant price else null
}