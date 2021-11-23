@extends('layouts.base')
@section('content')

<section id="breadcrumb" class="mb-4 mt-1 d-none d-lg-block">
    <nav aria-label="breadcrumb" class="bread py-1 bg-light shadow-none">
        <ol class="breadcrumb mt-3">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Hot Deal</li>
        </ol>
      </nav>
</section>


<section id="product-page">
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block">
               <div class="side sticky-top">
                <div id="brand-filter" class="">
                    <div class="brands p-3 bg-light">
                        <h5 class="mb-4">Hot Deals</h5>
                        <p>
                            <a href="" class="">Mac</a>
                            <a href="" class="float-end">2</a>
                        </p>
                        <p>
                            <a href="" class="">Dell</a>
                            <a href="" class="float-end">17</a>
                        </p>
                        <p>
                            <a href="" class="active">HP</a>
                            <a href="" class="float-end active">39</a>
                        </p>
                        <p>
                            <a href="" class="">Asus</a>
                            <a href="" class="float-end">25</a>
                        </p>
                        <p>
                            <a href="" class="">Acer</a>
                            <a href="" class="float-end">19</a>
                        </p>
                        <p>
                            <a href="" class="">Lenovo</a>
                            <a href="" class="float-end">29</a>
                        </p>
                        <p>
                            <a href="" class="">Microsoft</a>
                            <a href="" class="float-end">29</a>
                        </p>
                        <p>
                            <a href="" class="">MSI</a>
                            <a href="" class="float-end">29</a>
                        </p>

                    </div>
                </div>

                <div id="price-filter">
                    <div class="price bg-light mt-4 p-3">
                        <h5>Price Range</h5>

                            <fieldset class="filter-price">

                                <div class="price-field">
                                <input type="range"  min="200" max="500" value="100" id="lower" class="">
                                <input type="range" min="100" max="500" value="50023" id="upper" class="">
                                </div>
                                <div class="price-wrap">
                                <span class="price-title">FILTER</span>
                                <div class="price-wrap-1">
                                    <input id="one">
                                    <label for="one">$</label>
                                </div>
                                <div class="price-wrap_line">-</div>
                                <div class="price-wrap-2">
                                    <input id="two">
                                    <label for="two">$</label>
                                </div>
                                </div>
                            </fieldset>

                    </div>
                </div>


                <div id="color-filter">
                    <div class="color p-3 mt-4 bg-light">
                        <h5 class="mb-4">Color</h5>
                        <span>
                            <input type="color" value="#0000">
                        </span>
                        <span>
                            <input type="color" value="#ff0000">
                        </span>
                        <span>
                            <input type="color" value="red">
                        </span>
                        <span>
                            <input type="color" value="red">
                        </span>
                        <span>
                            <input type="color" value="red">
                        </span>
                        <span>
                            <input type="color"
                                value="#e66465">
                        </span>
                    </div>
                </div>

                <div id="brands">
                    <div class="brands p-3 bg-light mt-4">
                        <h5 class="mb-4">Brands</h5>
                        <p>
                            <a href="" class="">Mac</a>
                            <a href="" class="float-end">2</a>
                        </p>
                        <p>
                            <a href="" class="">Dell</a>
                            <a href="" class="float-end">17</a>
                        </p>
                        <p>
                            <a href="" class="active">HP</a>
                            <a href="" class="float-end active">39</a>
                        </p>
                        <p>
                            <a href="" class="">Asus</a>
                            <a href="" class="float-end">25</a>
                        </p>
                        <p>
                            <a href="" class="">Acer</a>
                            <a href="" class="float-end">19</a>
                        </p>


                    </div>
                </div>
               </div>
            </div>
            <div class="col-lg-9">
                <div id="product-poster">
                      <div class="pro-advert">
                          <img src="img\laptop-poster1.png" alt="">
                         <div class="content">
                            <h4>Hp Laptops</h4>
                            <p class="">Performance & Design. Taken right to the Edge.</p>
                            <button class="">SHOP NOW</button>
                         </div>
                      </div>
                </div>

                <div id="sorting-nav" class="">
                    <navs class="navbar navbar-expand-lg bg-light my-4">
                        <div class="sort">

                            <div class="item ms-2">
                                <span>  13 Items
                                </span>
                            </div>
                           <div class="sort mx-4 d-none d-lg-block">
                            Sort By

                            <select name="" id="" class=" ">
                                <option value="">filter</option>
                                <option value="">Name</option>
                                <option value="">Type</option>
                                <option value="">Date</option>
                            </select>
                           </div>



                           <div class="select d-none d-lg-block">
                            Show

                            <select name="" id="" class="">
                                <option value="">filter</option>
                                <option value="">Name</option>
                                <option value="">Type</option>
                                <option value="">Date</option>
                            </select>
                           </div>

                        </div>


                        <div class="ms-auto">
                            <button class="btn btn-light"><i class="fas fa-th"></i></button>
                            <button class="btn btn-light"><i class="fas fa-sliders-h"></i></button>
                        </div>
                    </navs>
                </div>



                <section id="product2">
                    <div class="pro-h">
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="product_view.html">
                                    <div class="p-img">
                                        <img src="img\laptop5.jpg" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <a href="product_view.html">
                                    <div class="p-desc px-2 py-1">
                                        <h5 class="p-name">HP Elitebook 820 G3 i5 6th Gen(8GB/500GB)</h5>
                                        <div class="reviews mt-2">
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span><i class="fas fa-star"></i></span>
                                            <span class="count mx-3"> 47 reviews </span>
                                            <span class="submit"> <a href="">Submit a Review</a> </span>
                                        </div> <hr>
                                        <div class="price d-flex mt-2">
                                            <h6 class="c-price">$299.99</h6>
                                            <h6 class="o-price mx-3">$499.99</h6>
                                            <h6 class="discount">40% Off</h6>
                                        </div>
                                        <div class="desc">
                                            <p class="small text-muted mt-1">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sint quisquam architecto. Modi quisquam, doloremque similique sed unde nihil laboriosam. Lorem ipsum dolor sit.
                                            </p>
                                        </div>
                                        <div class="btns">
                                           <a href="cart.html">
                                            <button class="atc"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</button>
                                           </a>
                                            <button class="wishlist ms-3"><i class="fas fa-heart"></i></button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="pro-h">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="p-img">
                                    <img src="img\laptop5.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="p-desc px-2 py-1">
                                    <h5 class="p-name">HP Elitebook 820 G3 i5 6th Gen(8GB/500GB)</h5>
                                    <div class="reviews mt-2">
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span class="count mx-3"> 47 reviews </span>
                                        <span class="submit"> <a href="">Submit a Review</a> </span>
                                    </div> <hr>
                                    <div class="price d-flex mt-2">
                                        <h6 class="c-price">$299.99</h6>
                                        <h6 class="o-price mx-3">$499.99</h6>
                                        <h6 class="discount">40% Off</h6>
                                    </div>
                                    <div class="desc">
                                        <p class="small text-muted mt-1">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sint quisquam architecto. Modi quisquam, doloremque similique sed unde nihil laboriosam. Lorem ipsum dolor sit.
                                        </p>
                                    </div>
                                    <div class="btns">
                                        <button class="atc"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</button>
                                        <button class="wishlist ms-3"><i class="fas fa-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pro-h">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="p-img">
                                    <img src="img\laptop5.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="p-desc px-2 py-1">
                                    <h5 class="p-name">HP Elitebook 820 G3 i5 6th Gen(8GB/500GB)</h5>
                                    <div class="reviews mt-2">
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span class="count mx-3"> 47 reviews </span>
                                        <span class="submit"> <a href="">Submit a Review</a> </span>
                                    </div> <hr>
                                    <div class="price d-flex mt-2">
                                        <h6 class="c-price">$299.99</h6>
                                        <h6 class="o-price mx-3">$499.99</h6>
                                        <h6 class="discount">40% Off</h6>
                                    </div>
                                    <div class="desc">
                                        <p class="small text-muted mt-1">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sint quisquam architecto. Modi quisquam, doloremque similique sed unde nihil laboriosam. Lorem ipsum dolor sit.
                                        </p>
                                    </div>
                                    <div class="btns">
                                        <button class="atc"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</button>
                                        <button class="wishlist ms-3"><i class="fas fa-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pro-h">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="p-img">
                                    <img src="img\laptop5.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="p-desc px-2 py-1">
                                    <h5 class="p-name">HP Elitebook 820 G3 i5 6th Gen(8GB/500GB)</h5>
                                    <div class="reviews mt-2">
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span class="count mx-3"> 47 reviews </span>
                                        <span class="submit"> <a href="">Submit a Review</a> </span>
                                    </div> <hr>
                                    <div class="price d-flex mt-2">
                                        <h6 class="c-price">$299.99</h6>
                                        <h6 class="o-price mx-3">$499.99</h6>
                                        <h6 class="discount">40% Off</h6>
                                    </div>
                                    <div class="desc">
                                        <p class="small text-muted mt-1">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sint quisquam architecto. Modi quisquam, doloremque similique sed unde nihil laboriosam. Lorem ipsum dolor sit.
                                        </p>
                                    </div>
                                    <div class="btns">
                                        <button class="atc"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</button>
                                        <button class="wishlist ms-3"><i class="fas fa-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pro-h">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="p-img">
                                    <img src="img\laptop5.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="p-desc px-2 py-1">
                                    <h5 class="p-name">HP Elitebook 820 G3 i5 6th Gen(8GB/500GB)</h5>
                                    <div class="reviews mt-2">
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span class="count mx-3"> 47 reviews </span>
                                        <span class="submit"> <a href="">Submit a Review</a> </span>
                                    </div> <hr>
                                    <div class="price d-flex mt-2">
                                        <h6 class="c-price">$299.99</h6>
                                        <h6 class="o-price mx-3">$499.99</h6>
                                        <h6 class="discount">40% Off</h6>
                                    </div>
                                    <div class="desc">
                                        <p class="small text-muted mt-1">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sint quisquam architecto. Modi quisquam, doloremque similique sed unde nihil laboriosam. Lorem ipsum dolor sit.
                                        </p>
                                    </div>
                                    <div class="btns">
                                        <button class="atc"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</button>
                                        <button class="wishlist ms-3"><i class="fas fa-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div id="page-no" class="mt-4">
                    <nav-p aria-label="..." class="p-0 d-flex justify-content-center align-item-center bg-light mb-0">
                        <ul class="pagination mb-0">
                          <li class="page-item">
                            <a class="page-link border-0" href="#" tabindex="-1" aria-disabled="true"><i class="fas fa-backward"></i></a>
                          </li>
                          <li class="page-item"><a class="page-link border-0" href="#">1</a></li>
                          <li class="page-item"><a class="page-link border-0" href="#">2</a></li>
                          <li class="page-item active" aria-current="page">
                            <a class="page-link border-0" href="#">3</a>
                          </li>
                          <li class="page-item"><a class="page-link border-0" href="#">4</a></li>

                          <li class="page-item"><a class="page-link border-0" href="#">5</a></li>
                          <li class="page-item">
                            <a class="page-link border-0" href="#"><i class="fas fa-forward"></i></a>
                          </li>
                        </ul>
                      </nav-p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
