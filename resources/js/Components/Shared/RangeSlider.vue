<template>
    <div class="d-inline-block rounded p-1" style="height:50px;width:100%">
        <div class="rangeslider">
            <input @click="rangeSlider('min')" type="range" min="1" max="1000" v-model="rangeMin" />
            <input @click="rangeSlider('max')" type="range" min="1" max="1000" v-model="rangeMax" />
            <span class="range_min light left fw-bold">{{ format_amount(rangeMin) }}</span>
            <span class="text-center" style="right:0">
                <InlineLoader styling="background:inherit;font-size:12px;color:forestgreen" text="Sorting..." v-if="loading"/>
                <div class="d-inline" v-else><i class="fa fa-minus" aria-hidden="true"></i></div>
            </span>
            <span class="range_max light right fw-bold">{{ format_amount(rangeMax) }}</span>
        </div>
    </div>
    
</template>
<script>
import axios from 'axios';
import InlineLoader from '@/Components/Shared/InlineLoader'
export default {
    components: {
        InlineLoader,
    },
    data() {
        return {
            loading: false, 
            minRangeMin: 1,
            minRangeMax: 1000,
            maxRangeMin: 1,
            maxRangeMax: 1000,
            rangeMin: 1,
            rangeMax: 1000,
            currency: '$',
        }
    },
    methods: {
        rangeSlider(origin) {
            let min_diff = 5;
            if (origin == 'min') {
                if (parseInt(this.rangeMin) + min_diff < parseInt(this.rangeMax)) {
                    this.minRangeMax = this.rangeMin;
                }else {
                    this.minRangeMax = parseInt(this.rangeMax) - min_diff;
                    this.rangeMin = this.addSeparator(parseInt(this.rangeMax) - min_diff);
                }
            
            }else {
                if (parseInt(this.rangeMax) - min_diff > parseInt(this.rangeMin)) {
                    this.maxRangeMin = this.rangeMax;
                }else {
                    this.maxRangeMin = parseInt(this.rangeMin) + min_diff;
                    this.rangeMax = this.addSeparator(parseInt(this.rangeMin) + min_diff);
                }
            }
            
            this.loading = true;
            this.priceSort();
        },
        async priceSort(get = false) {
            const res = await new Promise((resolve, reject) => {
                this.axiosPriceSort(this.rangeMin, this.rangeMax, get)
                .then((resp) => {
                    resolve(resp);
                    this.loading = false;
                    this.$inertia.reload();
                }).catch((err) => {
                    reject(err);
                    alert("Whoopsy! Server Error, try again later.");
                });
            });

            if (res.data) {
                this.rangeMin = res.data.min_price;
                this.rangeMax = res.data.max_price;
            }
        },
        addSeparator(nStr) {
            nStr += '';
            var x = nStr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        },
        format_amount(amount, suffix = false) {
            return !suffix ? this.currency + amount : amount + this.currency;
        },
        async axiosPriceSort(min_price, max_price, get) {
            return new Promise(
                (resolve, reject) => {
                    axios.post(`${this.$page.props.url}shop/price-sort`, 
                            {
                                min_price: min_price, 
                                max_price: max_price,
                                get: get,
                            }
                    )
                    .then((resp) => {
                        resolve(resp);
                    }).then(() => {}).catch((err) => {
                        reject("Whoop!: " + err);
                    })
                }
            ); 
        }
    },
    created() {
        this.priceSort('true');
    }
}
</script>
<style scoped>
    input[type='range'] {
    width: 210px;
    height: 30px;
    overflow: hidden;
    cursor: pointer;
    outline: none;
    }
    input[type='range'],
    input[type='range']::-webkit-slider-runnable-track,
    input[type='range']::-webkit-slider-thumb {
    -webkit-appearance: none;
        background: none;
    }
    input[type='range']::-webkit-slider-runnable-track {
    width: 200px;
    height: 3px;
    background: #ff2832;
    }

    input[type='range']:nth-child(2)::-webkit-slider-runnable-track{
    background: none;
    }

    input[type='range']::-webkit-slider-thumb {
    position: relative;
    height: 15px;
    width: 15px;
    margin-top: -7px;
    background: #fff;
    border: 1px solid #ff2832;
    border-radius: 25px;
    z-index: 1;
    }
    input[type='range']::-webkit-slider-thumb{
    border: 3PX solid #ff2832;
    }


    input[type='range']:nth-child(1)::-webkit-slider-thumb{
    z-index: 2;
    }

    .rangeslider{
        position: relative;
        height: 60px;
        width: 210px;
        display: inline-block;
        margin-top: -5px;
        margin-left: 20px;
    }
    .rangeslider input{
        position: absolute;
    }
    .rangeslider{
        position: absolute;
    }

    .rangeslider span{
        position: absolute;
        margin-top: 30px;
        left: 0;
    }

    .rangeslider .right{
    position: relative;
    float: right;
    margin-right: -5px;
    }


    /* Proof of concept for Firefox */
    @-moz-document url-prefix() {
    .rangeslider::before{
        content:'';
        width:100%;
        height:2px;
        background: #ff2832;
        display:block;
        position: relative;
        top:16px;
    }

    input[type='range']:nth-child(1){
        position:absolute;
        top:35px !important;
        overflow:visible !important;
        height:0;
    }

    input[type='range']:nth-child(2){
        position:absolute;
        top:35px !important;
        overflow:visible !important;
        height:0;
    }
    input[type='range']::-moz-range-thumb {
    position: relative;
    height: 15px;
    width: 15px;
    margin-top: -7px;
    background: #fff;
    border: 1px solid #ff2832;
    border-radius: 25px;
    z-index: 1;
    }

    input[type='range']:nth-child(1)::-moz-range-thumb {
        transform: translateY(-20px);    
    }
    input[type='range']:nth-child(2)::-moz-range-thumb {
        transform: translateY(-20px);    
    }
    }
</style>