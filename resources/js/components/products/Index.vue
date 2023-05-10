<template>
    <div class="container pb-5 mb-5">
        <div id="search-box" class="shadow-sm">
            <div class="row justify-content-center">
                <div class="col-sm-2 text-md-right">
                    <button type="button" class="btn btn-theme chart-btn" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-bar-chart"></i> Show Chart
                    </button>
                </div>
                <div class="col-sm-6 px-3">
                    <input type="text" v-model="search_keyword" placeholder="SEARCH PRODUCT">
                    <div class="col-sm-12" id="search-body" v-if="result.length > 0">
                        <div class="row" v-for="row in result" :key="row.id">
                            <a :href="'/products/view/'+row._id" class="pointer">
                            <div class="row">
                                <div class="col-sm-2 search-image"><img :src="row.product_image" :alt="row.product_title" /></div>
                                <div class="col-sm-9 search-text" style="margin:auto;"><b>{{ row.product_title }}</b></div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="row" id="data">
            <div class="col-lg-3 col-md-4 col-sm-6 p-0 my-0" v-for="data in pages">
                <a :href="'/products/view/'+data._id" class="pointer">
                <div class="card products-container">
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12">
                            <img :src="data.product_image" :alt="data.product_title" />
                        </div>
                        <div class="product-details">
                            <span id="product-title">{{ data.product_title }}</span>
                            <span id="product-price">{{ data.price }}</span>
                        </div> 
                    </div>
                </div>
                </a> 
            </div>
            <div id="pagination">
                <jw-pagination :items="products" @changePage="onChangePage"></jw-pagination>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                id:null,
                product_title:null,
                price:null,
                quantity:null,
                product_image:null,
                product_ingredients:null,
                sku:null,
                search_keyword:null,
                result:[],
                products:{},
                pages: [],
            }
        },

        mounted () {
            this.getProducts();
        },
        watch: {
            search_keyword(after, before) {
                this.searchProduct();
            }
        },

        methods: {

            /**
             * Fetch all rows
             *
             * @return void
             */

            getProducts () {
                this.products = [];
                axios.get(`/api/products`)
                    .then((response) => {
                        this.products = response.data;
                    }).catch((error) => {
                        console.debug(`Error while fetching products ${JSON.stringify(error)}`)
                    })
            },
            /**
             * Search products
             *
             * @return void
             */
            searchProduct () {
                axios.get(`/api/products/search`, {params:{ keyword:this.search_keyword}})
                    .then((response) => {
                        this.result = response.data;
                    }).catch((error) => {
                        console.debug(`Error while fetching products ${JSON.stringify(error)}`)
                    })
            },
            onChangePage(pages) {
                this.pages = pages;
            }
        }
    }
</script>