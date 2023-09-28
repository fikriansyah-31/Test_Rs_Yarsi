
<template>
    <div class="bg-blue-500 min-h-screen flex justify-center items-center">
        <div class="w-full sm:w-96 p-6 bg-slate-100 rounded shadow-sm shadow-black">
        <h1 class="text-3xl font-bold mb-6 text-center">Login</h1>

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
        <button
          @click="login"
          :disabled="isLogin"
          class="w-full md:w-auto px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300"
        >
          <span v-if="isLogin">Silahkan Tunggu....</span>
          <span v-else>Login</span>
        </button>
      </div>
        <!-- Pemberitahuan (alert) -->
        <div
        v-if="loginSuccess"
        class="my-2 text-sm text-green-700 bg-green-100 border border-green-300 py-1 px-3 rounded"
      >
        Login Berhasil
      </div>
    </div>
  </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "Login",
    data() {
      return {
        formData: {
          email: "",
          password: "",
        },
        loginSuccess: false,
        isLogin: false,
      };
    },
    methods: {
      login() {
        this.isLogin = true;
  
        console.log("Data Login:", this.formData);
  
        // Kirim data ke API untuk login
        axios
          .post("http://127.0.0.1:8000/api/auth/login", this.formData)
          .then((response) => {
            console.log("Response dari API:", response.data);
  
            // Simpan access token ke localStorage
            localStorage.setItem("accessToken", response.data.access_token);
  
            // Setelah berhasil login, buat permintaan HTTP untuk mengambil data pengguna
            this.fetchUserData();
  
            // Menampilkan alert
            this.loginSuccess = true;
            setTimeout(() => {
              this.loginSuccess = false;
              this.isLogin = false;
  
              // Redirect ke halaman lain jika diperlukan
              this.$router.push("/");
            }, 5000);
          })
          .catch((error) => {
            console.error("Error:", error);
            this.isLogin = false;
          });
      },
      fetchUserData() {
        const token = localStorage.getItem("accessToken");
  
        if (token) {
          axios
            .get("http://127.0.0.1:8000/api/auth/user", {
              headers: {
                Authorization: `Bearer ${token}`, 
              },
            })
            
            .catch((error) => {
            });
        }
      },
    },
  };
  </script>
  
  
  <style scoped>
  .form-input {
    @apply block w-full px-4 py-2 rounded border border-gray-300 text-gray-800 placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-300;
  }
  </style>
  