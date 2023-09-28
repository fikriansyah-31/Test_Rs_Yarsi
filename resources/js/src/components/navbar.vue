<template>
    <div>
      <nav class="bg-blue-500 border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl mx-auto p-4">
          <div class="flex items-center justify-between">
            <router-link to="/" class="flex items-center">
              <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white text-yellow-50">Testing Table</span>
            </router-link>
            <div class="flex items-center relative " @click="toggleDropdown">
              <button
                type="button"
                class="flex ml-3 text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
              >
                <span class="sr-only">User menu</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="w-5 h-5 text-gray-300 dark:text-gray-600"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M8 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0V1a1 1 0 0 1 1-1zm5.293 1.293a1 1 0 0 1 1.414 1.414L9.414 10l5.293 5.293a1 1 0 0 1-1.414 1.414L8 11.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 10 1.293 4.707a1 1 0 1 1 1.414-1.414L8 8.586l5.293-5.293z"
                  />
                </svg>
              </button>
              <!-- Dropdown menu -->
              <div
                v-if="isDropdownOpen"
                class="absolute right-0 mt-40 py-2 px-2 text-base bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
              >
                <div class="px-4 py-3">
                  <span class="block text-sm text-gray-900 dark:text-white">{{ currentUser ? currentUser.name : 'Loading...' }}</span>
                  <span class="block text-sm text-gray-500 dark:text-gray-400">{{ currentUser ? currentUser.email : 'Loading...' }}</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                  <li>
                    <a
                      href="#"
                      @click="logout"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white cursor-pointer"
                    >
                      Sign out
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: "Navbar",
    data() {
      return {
        currentUser: null,
        isDropdownOpen: false,
      };
    },
    created() {
      this.getCurrentUser();
    },
    methods: {
      getCurrentUser() {
        const token = localStorage.getItem('accessToken');
  
        if (token) {
          axios.get('http://127.0.0.1:8000/api/auth/user', {
            headers: {
              Authorization: `Bearer ${token}`, 
            },
          })
            .then((response) => {
              this.currentUser = response.data;
            })
            .catch((error) => {
              console.error('Error fetching current user:', error);
            });
        } else {
          console.warn('Token not found in localStorage.');
        }
      },
      toggleDropdown() {
        this.isDropdownOpen = !this.isDropdownOpen;
      },
      logout() {
        const token = localStorage.getItem('accessToken');
  
        if (token) {
          // Lakukan permintaan HTTP untuk logout
          axios.post('http://127.0.0.1:8000/api/auth/logout', null, {
            headers: {
              Authorization: `Bearer ${token}`, // Tambahkan token ke header otorisasi
            },
          })
            .then(() => {
              // Hapus token dari penyimpanan lokal jika perlu
              localStorage.removeItem('accessToken');
              // Redirect ke halaman login jika diperlukan
              this.$router.push('/login');
            })
            .catch((error) => {
              console.error('Error logging out:', error);
            });
        } else {
          console.warn('Token not found in localStorage.');
        }
      },
    },
  };
  </script>
  