<template>
  <div class="bg-gray-100 min-h-screen flex justify-center items-center">
    <div class="w-full sm:w-96 p-6 bg-white rounded shadow-md">
      <h1 class="text-3xl font-bold mb-6 text-center">Register</h1>

      <!-- Nama -->
      <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Nama</label>
        <input v-model="formData.name" type="text" id="name" name="name" class="form-input" />
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
        <input v-model="formData.email" type="email" id="email" name="email" class="form-input" />
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
        <input v-model="formData.password" type="password" id="password" name="password" class="form-input" />
      </div>

      <!-- Tombol Daftar -->
      <div class="text-center">
        <button @click="register" class="w-full md:w-auto px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
          Daftar
        </button>
      </div>
    </div>
  </div>
  </template>
  
  <script>
  export default {
    name: "Register",
    data() {
      return {
        formData: {
          name: "",
          email: "",
          password: "",
        },
      };
    },
    methods: {
      register() {
        // Kirim data pendaftaran ke server atau lakukan validasi sesuai kebutuhan
        // Anda dapat mengakses data melalui this.formData
        console.log("Data Pendaftaran:", this.formData);
      },
    },
  };
  </script>
  
  <style scoped>
  /* Tambahkan gaya Tailwind CSS sesuai kebutuhan */
  .form-input {
    @apply block w-full px-4 py-2 rounded border border-gray-300 text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-300;
  }
  </style>
  