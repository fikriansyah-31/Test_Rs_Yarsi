
<template>
    <div class="bg-green-400 min-h-screen flex justify-center items-center">
        <div class="w-full sm:w-96 p-6 bg-slate-100 rounded shadow-sm shadow-black">
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
      <div
      v-if="registrationSuccess"
      class="my-2 text-sm text-green-700 bg-green-100 border border-green-300 py-1 px-3 rounded"
    >
      Pendaftaran berhasil!
    </div>
      <div class="text-center">
        <button
          @click="register"
          :disabled="isRegistering"
          class="w-full md:w-auto px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300"
        >
          <span v-if="isRegistering">Mendaftar...</span>
          <span v-else>Daftar</span>
        </button>
      </div>
        <!-- Pemberitahuan (alert) -->
    </div>
  </div>
  </template>
  
  <script>
import axios from "axios"; // Import axios

export default {
  name: "Register",
  data() {
    return {
      formData: {
        name: "",
        email: "",
        password: "",
      },
      registrationSuccess: false,
      isRegistering: false,
    };
  },
  methods: {
    register() {
        this.isRegistering = true;

      console.log("Data Pendaftaran:", this.formData);

      // Kirim data ke API
      axios
        .post("http://127.0.0.1:8000/api/auth/register", this.formData)
        .then((response) => {
          console.log("Response dari API:", response.data);
          //menampilkan alert
          this.registrationSuccess = true;
          setTimeout (() =>{
              this.registrationSuccess = false
              this.isRegistering = false;
              this.$router.push("/login");
          },5000) 
        })
        .catch((error) => {
          console.error("Error:", error);
          this.isRegistering = false;

        });
    },
  },
};
</script>
  
  <style scoped>
  .form-input {
    @apply block w-full px-4 py-2 rounded border border-gray-300 text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-300;
  }
  </style>
  