<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                Judul Buku
              </th>
              <th scope="col" class="px-6 py-3">
                Pengarang
              </th>
              <th scope="col" class="px-6 py-3">
                Tanggal Terbit
              </th>
              <th scope="col" class="px-6 py-3">
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(product, index) in products"
              :key="index"
              :class="{
                'bg-white': index % 2 === 0,
                'bg-gray-100 dark:bg-gray-800 dark:border-gray-700': index % 2 !== 0,
              }"
            >
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ product.name }}
              </th>
              <td class="px-6 py-4">{{ product.color }}</td>
              <td class="px-6 py-4">{{ product.category }}</td>
              <td class="px-6 py-4">{{ product.price }}</td>
              <td class="px-6 py-4">
                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
    
    
    <script>

    
    </script>
    
    <style scoped>
    
    </style>