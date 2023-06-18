<template>
  <div class="container">
    <h1>Crypto table</h1>
    <input type="text" id="search-by" v-model="searchQuery" placeholder="Search by name or symbol">
    <div class="table-wrapper">

      <table>
        <tr>
          <th>Rank</th>
          <th>Name</th>
          <th>Symbol</th>
          <th>Total Supply</th>
          <th>View</th>
        </tr>
        <tr v-for="currency in filteredCurrencies" :key="currency.id">
          <td class="rank">{{ currency.meta_data.cmc_rank }}</td>
          <td class="name">{{ currency.name }}</td>
          <td class="symbol">{{ currency.meta_data.symbol }}</td>
          <td class="total-supply">{{ currency.meta_data.total_supply }}</td>
          <td class="view" @click="togglePopup(currency.coinmarketplace_id)">View details</td>
        </tr>
      </table>
    </div>
    <div class="pagination">
      <button @click="fetchPage(data.prevPageUrl)" :disabled="!data.prevPageUrl">Previous</button>
      <button @click="fetchPage(data.nextPageUrl)" :disabled="!data.nextPageUrl">Next</button>
    </div>
    <PopupContent v-if="data.isPopupOpen" :currencyId="data.selectedCurrency" :isPopupOpen="data.isPopupOpen"
      @closePopup="closePopup" />
  </div>
</template>
<script>
import { onMounted, ref, reactive, computed } from 'vue';
import axios from 'axios';
import PopupContent from './PopupContent.vue';

export default {
  name: 'YourComponent',
  components: {
    PopupContent
  },
  setup() {
    const searchQuery = ref('');
    const data = reactive({
      currencies: [],
      isPopupOpen: false,
      selectedCurrency: null,
      prevPageUrl: '',
      nextPageUrl: ''
    });

    const fetchData = async (url) => {
      try {
        const response = await axios.get(url);
        const { data: currencies, prev_page_url, next_page_url } = response.data;
        data.currencies = currencies;
        data.prevPageUrl = prev_page_url;
        data.nextPageUrl = next_page_url;
      } catch (error) {
        console.error(error);
      }
    };

    const togglePopup = (currency) => {
      data.selectedCurrency = currency;
      data.isPopupOpen = true;
    };

    const closePopup = () => {
      data.isPopupOpen = false;
    };

    const fetchPage = async (url) => {
      try {
        const response = await axios.get(url);
        const { data: currencies, prev_page_url, next_page_url } = response.data;
        data.currencies = currencies;
        data.prevPageUrl = prev_page_url || '';
        data.nextPageUrl = next_page_url || '';
      } catch (error) {
        console.error(error);
      }
    };


    const filteredCurrencies = computed(() => {
      const query = searchQuery.value.toLowerCase();
      if (query === '') {
        return data.currencies;
      } else {
        return data.currencies.filter(
          currency =>
            currency.name.toLowerCase().includes(query) ||
            currency.meta_data.symbol.toLowerCase().includes(query)
        );
      }
    });
    onMounted(() => {
      fetchData('/api/currency');
    });

    return {
      searchQuery,
      data,
      togglePopup,
      closePopup,
      fetchPage,
      filteredCurrencies
    };
  }
};
</script>

