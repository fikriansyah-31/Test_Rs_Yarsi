<template>
    <div>
      <Navbar />
      <div class="mt-5 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-2">
        <div class="w-full md:w-1/6">
          <label class="block text-sm mb-2 text-center font-medium text-gray-900 dark:text-white">
            Judul Buku
          </label>
          <input
            class="w-full p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="text"
          >
        </div>
        <div class="w-full md:w-1/6">
          <label class="block text-sm mb-2 text-center font-medium text-gray-900 dark:text-white">
            Pengarang
          </label>
          <input
            class="w-full p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="text"
          >
        </div>
        <div class="w-full md:w-1/6">
          <label class="block text-sm mb-2 text-center font-medium text-gray-900 dark:text-white">
            Tanggal Penerbit
          </label>
          <input
            class="w-full p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="date"
          >
        </div>
        <div class="w-full md:w-1/6">
          <label class="block text-sm mb-2 text-center font-medium text-gray-900 dark:text-white">
            Pencarian
          </label>
          <input
            class="w-full p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="text"
            placeholder="Cari..."
          >
        </div>
        <div class="w-full md:w-1/12">
          <button
            class="w-full py-1 mt-7 md:ms-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300"
          >
            <span>Submit</span>
          </button>
        </div>
      </div>
      <div class="mt-12">
        <Table />
      </div>
    </div>
  </template>
  
  
  <script>
  import Navbar from '../components/navbar.vue';
  import Table from '../components/table.vue';
  
  export default {
    name: "Home",
    components: { Navbar, Table },
    data() {
      return {
        // inputFields: [1, 2, 3], // Untuk membuat tiga input field
      };
    },
  };
  </script>

<style scoped>

</style>