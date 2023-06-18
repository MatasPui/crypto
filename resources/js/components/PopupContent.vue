<template>
    <div class="popup-content">
        <div class="container">
                <div class="close" @click="closePopup">X</div>
                <div class="item-data">
                    <template v-if="currencyData.length > 0">
                        <template class="item" v-for="currency in currencyData" :key="currency.id">
                            <div class="main-information">
                                <div class="general">
                                    <div class="info ranking">
                                       <span>Ranking</span> {{ currency.meta_data.cmc_rank }}
                                    </div>
                                    <div class="info logo">
                                        <img :src="currency.meta_data.logo" :alt="currency.name">
                                    </div>
                                    <div class="info name">
                                        <span>Name:</span> {{ currency.name }}
                                    </div>
                                    <div class="info symbol">
                                        <span>Symbol:</span> {{ currency.meta_data.circulating_supply }}
                                    </div>
                                </div>
                                <div class="dates">
                                    <div class="info created">
                                        <span>Created at:</span> {{ currency.meta_data.created_at }}
                                    </div>
                                    <div class="info launched">
                                        <span>Launched at:</span> {{ currency.meta_data.date_launched }}
                                    </div>
                                    <div class="info added">
                                        <span>Added at:</span> {{ currency.meta_data.date_added }}
                                    </div>
                                </div>
                            </div>
                            <div class="description">
                                {{ currency.meta_data.description }}
                            </div>
                        </template>
                    </template>
                    <template v-else>
                        <svg version="1.1" id="L4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                            <circle fill="#fff" stroke="none" cx="6" cy="50" r="6">
                                <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin="0.1" />
                            </circle>
                            <circle fill="#fff" stroke="none" cx="26" cy="50" r="6">
                                <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin="0.2" />
                            </circle>
                            <circle fill="#fff" stroke="none" cx="46" cy="50" r="6">
                                <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite" begin="0.3" />
                            </circle>
                        </svg>
                    </template>
                </div>
        </div>
    </div>
</template>
  

<script>
export default {
    props: {
        currencyId: {
            type: Number,
            required: true,
        },
        isPopupOpen: {
            type: Boolean,
            required: true,
        }
    },
    data() {
        return {
            currencyData: [],
        };
    },
    mounted() {
        this.fetchData(this.currencyId);
    },

    methods: {
        async fetchData(id) {
            try {
                const response = await axios.get(`/api/currency/single?id=${id}`);
                this.currencyData = [response.data];
            } catch (error) {
                console.error(error);
            }
        },
        closePopup() {
            this.$emit('closePopup');
        },
    },
}
</script>
  