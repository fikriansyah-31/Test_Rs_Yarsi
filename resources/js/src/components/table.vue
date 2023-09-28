<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <div class="mb-4 flex items-center">
        <input
          v-model="searchQuery"
          @input="performSearch"
          class="w-1/6 ms-12 text-center p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          type="text"
          placeholder="Cari Judul Buku"
        />
      </div>
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3 text-center">
              Judul Buku
            </th>
            <th scope="col" class="px-6 py-3 text-center">
              Pengarang
            </th>
            <th scope="col" class="px-6 py-3 text-center">
              Tanggal Terbit
            </th>
            <th scope="col" class="px-6 py-3 text-center">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(book, index) in filteredBooks"
            :key="index"
            :class="{
              'bg-white': index % 2 === 0,
              'bg-gray-100 dark:bg-gray-800 dark:border-gray-700': index % 2 !== 0,
            }"
          >
            <td class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
              {{ book.judul }}
            </td>
            <td class="px-6 py-4 text-center">{{ book.pengarang }}</td>
            <td class="px-6 py-4 text-center">{{ formatDate(book.tanggal_publikasi) }}</td>
            <td class="px-6 py-4 text-center">
            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2" @click="editBook(book)">Edit</a>
            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-2" @click="deleteBook(book.id)">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- Form Edit -->
      <div v-if="editingBook" class="mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
        <h2 class="text-lg font-semibold mb-2">Edit Buku</h2>
        <div class="mb-2">
          <label for="editedJudul" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
            Judul Buku
          </label>
          <input
            v-model="editedBook.judul"
            id="editedJudul"
            class="w-full p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="text"
          />
        </div>
        <div class="mb-2">
          <label for="editedPengarang" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
            Pengarang
          </label>
          <input
            v-model="editedBook.pengarang"
            id="editedPengarang"
            class="w-full p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="text"
          />
        </div>
        <div class="mb-2">
          <label for="editedTanggalPublikasi" class="block text-sm mb-2 font-medium text-gray-900 dark:text-white">
            Tanggal Terbit
          </label>
          <input
            v-model="editedBook.tanggal_publikasi"
            id="editedTanggalPublikasi"
            class="w-full p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            type="date"
          />
        </div>
        <div class="flex justify-center mt-4">
          <button
            @click="saveEdit"
            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300"
          >
            Simpan
          </button>
          <button
            @click="cancelEdit"
            class="ml-2 px-4 py-2 bg-gray-400 text-gray-800 font-semibold rounded hover:bg-gray-500 focus:outline-none focus:ring focus:ring-gray-300"
          >
            Batal
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: "Table",
    data() {
      return {
        books: [],
        searchQuery: "",
        filteredBooks: [],
        editingBook: null,
        editedBook: {
          judul: "",
          pengarang: "",
          tanggal_publikasi: "",
        },
      };
    },
    mounted() {
      this.fetchBooks();
    },
    methods: {
      fetchBooks() {
        axios
          .get("http://127.0.0.1:8000/api/buku")
          .then((response) => {
            this.books = response.data.data;
            this.filteredBooks = this.books;
          })
          .catch((error) => {
            console.error("Error:", error);
            this.books = [];
            this.filteredBooks = [];
          });
      },
      formatDate(dateString) {
        if (!dateString || dateString === 'null' || dateString === 'undefined' || dateString === '') {
          return 'Tanggal tidak tersedia';
        }
  
        try {
          const options = { year: 'numeric', month: 'long', day: 'numeric' };
          return new Date(dateString).toLocaleDateString(undefined, options);
        } catch (error) {
          console.error("Error parsing date:", error);
          return 'Format tanggal salah';
        }
      },
      performSearch() {
        if (!this.searchQuery) {
          this.filteredBooks = this.books;
          return;
        }
  
        this.filteredBooks = this.books.filter((book) =>
          book.judul.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      },
      editBook(book) {
        this.editingBook = book;
        this.editedBook.judul = book.judul;
        this.editedBook.pengarang = book.pengarang;
        this.editedBook.tanggal_publikasi = book.tanggal_publikasi;
      },
      cancelEdit() {
        this.editingBook = null;
        this.editedBook = {
          judul: "",
          pengarang: "",
          tanggal_publikasi: "",
        };
      },
      saveEdit() {
      
        const editedData = {
          judul: this.editedBook.judul,
          pengarang: this.editedBook.pengarang,
          tanggal_publikasi: this.editedBook.tanggal_publikasi,
        };
  
        axios
          .put(`http://127.0.0.1:8000/api/buku/${this.editingBook.id}`, editedData)
          .then((response) => {
            console.log("Data berhasil diperbarui:", response.data);
            this.editingBook = null;
            this.editedBook = {
              judul: "",
              pengarang: "",
              tanggal_publikasi: "",
            };
            this.fetchBooks(); 
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      },
      deleteBook(bookId) {
        axios
          .delete(`http://127.0.0.1:8000/api/buku/${bookId}`)
          .then((response) => {
            console.log("Data berhasil dihapus:", response.data);
            this.fetchBooks(); 
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      },
    },
  };
  </script>
  