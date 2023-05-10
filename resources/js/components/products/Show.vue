<template>
    <div class="container mt-2 px-3">
        <div class="row">
            <div class="card col-lg-6 col-md-6 bg-default px-2">
                <img :src="data.product_image" :alt="data.product_title" />
            </div>
            <div class="card col-lg-6 col-sm-6 bg-default">
                <h2><b><input typ="text" class="w-100 form readonly product_title" 
                        v-model="data.product_title" @blur="save()" readonly></b></h2>
                <div class="row px-3">
                <button type="button" class="btn btn-theme btn-edit col-sm-3">
                    <i class="fa fa-edit"></i> Edit
                </button>
                &nbsp;
                <button type="button" class="btn btn-info btn-cancel col-sm-3">
                    <i class="fa fa-remove"></i> Stop Edit
                </button>
                </div> 
                <hr>
                <div class="row my-1">
                    <div class="col-sm-4"><b>Price</b>: </div>
                    <div class="col-sm-8"><span id="product-price">{{ data.price }}</span></div>
                </div>
                <div class="row my-1">
                    <div class="col-sm-4"><b>Quantity</b>: </div>
                    <div class="col-sm-4">
                        <span id="product-price">
                            <input type="number" name="quantity" @blur="save()" class="w-100 form readonly quantity" v-model="data.quantity"
                                readonly>
                        </span>
                    </div>
                </div>
                <div class="row my-1">
                    <div class="col-sm-12"><b>Product Ingredients</b>: </div>
                    <div class="col-sm-12">
                        <textarea name="product_ingredients" @blur="save()" class="w-100 form readonly product_ingredients" v-model="data.product_ingredients" rows="5" readonly></textarea>
                    </div>
                </div>
                <div class="row my-1">
                    <div class="col-sm-4"><b>SKU</b>: </div>
                    <div class="col-sm-8"><span id="product-price">{{ data.sku }}</span></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ["data"],
        mounted () {
        },

        methods: {
            save() {
                const value = {
                    _id:this.data._id,
                    product_title: this.data.product_title,
                    quantity: this.data.quantity,
                    product_ingredients: this.data.product_ingredients,
                };
                axios.put(`/api/products/update/${this.data._id}`, value)
                    .then((response) => {
                        console.log(response);
                    }).catch((error) => {
                        console.debug(`Error while fetching products ${JSON.stringify(error)}`)
                    })
            }
        }
    }
</script>