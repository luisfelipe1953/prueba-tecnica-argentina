import { ref } from "vue";

axios.defaults.baseURL = "http://127.0.0.1:8000/api/";

export default function useQueryUsdBtc() {
  const result = ref({});
  const priceBitcoin = ref([]);
  const errors = ref({});

  const getUsdToBitcoin = async (form) => {
    errors.value = "";
    try {
      const response = await axios.post("query/usd-to-btc", form.value);
      result.value = response.data;
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response;
      }
    }
  };

  const getPriceBitcoin = async () => {
    const response = await axios.get("price-bitcoin");
    priceBitcoin.value = response.data;
  };

  const getBitcoinToUsd = async (form) => {
    errors.value = "";
    try {
      const response = await axios.post("query/btc-to-usd", form.value);
      result.value = response.data;
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response;
      }
    }
  };

  return {
    result,
    priceBitcoin,
    getPriceBitcoin,
    getUsdToBitcoin,
    getBitcoinToUsd,
    errors,
  };
}