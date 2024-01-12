<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import useQueryUsdBtc from "../composables/index.js";

const {
  getUsdToBitcoin,
  getBitcoinToUsd,
  getPriceBitcoin,
  errors,
  result,
  priceBitcoin,
} = useQueryUsdBtc();

const form = ref({
  usd_amount: "",
  btc_amount: "",
});

let debounceTimer;

const debounce = (func, delay) => {
  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(() => {
    func();
  }, delay);
};

const loading = ref(false);

const handleInputUsd = () => {
  form.value.btc_amount = 0;
  debounce(async () => {
    loading.value = true;
    try {
      if (form.value.usd_amount === "") {
        form.value.btc_amount = 0;
        form.value.usd_amount = 0;
      } else {
        await getUsdToBitcoin(form);
        form.value.btc_amount = result.value;
      }
    } finally {
      loading.value = false;
    }
  }, 500);
};

const handleInputBtc = () => {
  form.value.usd_amount = 0;
  debounce(async () => {
    loading.value = true;
    try {
      if (form.value.btc_amount === "") {
        form.value.btc_amount = 0;
        form.value.usd_amount = 0;
      } else {
        await getBitcoinToUsd(form);
        form.value.usd_amount = result.value;
      }
    } finally {
      loading.value = false;
    }
  }, 500);
};

const fetchData = async () => {
  await getPriceBitcoin();
  console.log(priceBitcoin.value);
};

onMounted(() => {
  fetchData();
  // Llama a fetchData cada 30 segundos
  const fetchDataInterval = setInterval(fetchData, 30000);
  onUnmounted(() => clearInterval(fetchDataInterval));
});
</script>
<template>
  <div class="h-screen flex items-center justify-center">
    <form class="max-w-md mx-auto shadow-black p-4 border rounded-md w-full">
      <p class="mb-6">Convert Usd and Bitcoin</p>
      <div v-if="errors.data">
        <p
          class="apl-[30px] pr-[15px] py-[15px] uppercase m-0 text-xs font-bold bg-red-200 border-l-8 border-red-800"
        >
          {{ errors.data.message }}
        </p>
      </div>
      <div class="grid grid-cols-2 gap-12">
        <div class="mb-5">
          <label
            for="email"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >USD</label
          >

          <input
            type="number"
            id="USD"
            v-model="form.usd_amount"
            @keydown="handleInputUsd"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="USD"
          />
        </div>
        <div class="mb-5">
          <label
            for="password"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >BTC</label
          >
          <input
            type="number"
            id="BTC"
            v-model="form.btc_amount"
            @keydown="handleInputBtc"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="BTC"
          />
        </div>
      </div>
      <div v-if="loading" class="flex items-center mb-5">
        <svg
          class="animate-spin h-5 text-blue-500 mr-2"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
        >
          <circle
            class="opacity-25"
            cx="12"
            cy="12"
            r="10"
            stroke="currentColor"
            stroke-width="4"
          ></circle>
          <path
            class="opacity-75"
            fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
          ></path>
        </svg>
        Cargando...
      </div>
      <div>
        <p>1 BTC = ${{ priceBitcoin }}</p>
      </div>
    </form>
  </div>
</template>

<style scoped>
.shadow-black {
  box-shadow: rgb(0, 0, 0) 0px 0px 0px 2px, rgb(0, 0, 0) 0px 4px 6px -1px,
    rgb(0, 0, 0) 0px 1px 0px inset;
}
</style>
