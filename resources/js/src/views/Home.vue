<template>
    <div>
      <Navbar />
      <div class="mt-5 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-2">
        <div class="w-full md:w-1/6">
          <label class="block text-sm mb-2 ms-20 text-center font-medium text-gray-900 dark:text-white">
            Judul Buku
          </label>
          <input
            v-model="formData.judul"
            class="w-full ms-12 p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="text"
            placeholder="Judul Buku"
          >
        </div>
        <div class="w-full md:w-1/6">
          <label class="block text-sm mb-2 ms-28 text-center font-medium text-gray-900 dark:text-white">
            Pengarang
          </label>
          <input
            v-model="formData.pengarang"
            class="w-full p-2 ms-16 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="text"
            placeholder="Pengarang"
          >
        </div>
        <div class="w-full md:w-1/6">
          <label class="block text-sm mb-2 ms-32 text-center font-medium text-gray-900 dark:text-white">
            Tanggal Penerbit
          </label>
          <input
            v-model="formData.tanggal_publikasi"
            class="w-full p-2 ms-20 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="date"
          >
        </div>
      
        <div class="w-full md:w-1/12">
          <button
            @click="submitForm"
            class="w-full py-1 mt-7 md:ms-24 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300"
          >
            <span>Submit</span>
          </button>
        </div>
      </div>
      <div class="mt-12">
        <Table ref="table" />
      </div>
    </div>
  </template>
  
  <script>
  import Navbar from '../components/navbar.vue';
  import Table from '../components/table.vue';
  import axios from 'axios';
  
  export default {
    name: "Home",
    components: { Navbar, Table },
    data() {
      return {
        formData: {
          judul: "",
          pengarang: "",
          tanggal_publikasi: "",
        },
      };
    },
    methods: {
      submitForm() {
        // Format tanggal sesuai dengan "YYYY-MM-DD"
        const formattedTanggal = new Date(this.formData.tanggal_publikasi).toISOString().slice(0, 10);
  
        // Buat objek data yang akan dikirim
        const postData = {
          judul: this.formData.judul,
          pengarang: this.formData.pengarang,
          tanggal_publikasi: formattedTanggal,
        };
  
        axios
          .post("http://127.0.0.1:8000/api/buku", postData)
          .then((response) => {
            console.log("Data berhasil dikirim:", response.data);
            this.formData = {
              judul: "",
              pengarang: "",
              tanggal_publikasi: "",
            };
            this.$refs.table.fetchBooks();
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      },
    },
  };
  </script>
  