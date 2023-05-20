<template>
  <div class="fixed top-0 left-0 w-1/4 bg-white hidden md:block">
    <div class="h-screen">
      <div class="mx-2 mt-4 lg:mx-6 lg:mt-10">
        <span class="text-gray-600 ml-4 text-2xl font-bold">
          <Link :href="route('home')">
            {{ $page.props.shared.appName }}
          </Link>
        </span>
      </div>
      <nav class="mt-4 px-3 lg:mt-10 lg:px-6">
        <Link
          class="hover:text-gray-800 hover:bg-gray-100 flex items-center my-3 p-3 lg:my-4 transition-colors duration-200 text-gray-600 rounded-lg"
          :href="route('home')"
          :class="{'bg-gray-100': $page.component === 'HomeIndex'}"
        >
          <vue-feather
            type="home"
            class="ml-3"
          />
          <span class="mx-4 text-lg font-normal">
            Dashboard
          </span>
          <span class="flex-grow text-right" />
        </Link>
        <Link
          class="hover:text-gray-800 hover:bg-gray-100 flex items-center my-3 p-3 lg:my-4 transition-colors duration-200 text-gray-600 rounded-lg"
          :href="route('folders.index')"
          :class="{'bg-gray-100': $page.component.startsWith('Folder')}"
        >
          <vue-feather
            type="image"
            class="ml-3"
          />
          <span class="mx-4 text-lg font-normal">
            Images
          </span>
          <span class="flex-grow text-right" />
        </Link>
        <Link
          class="hover:text-gray-800 hover:bg-gray-100 flex items-center my-3 p-3 lg:my-4 transition-colors duration-200 text-gray-600 rounded-lg"
          :class="{'bg-gray-100': $page.component.startsWith('File')}"
          :href="route('files.index')"
        >
          <vue-feather
            type="file"
            class="ml-3"
          />
          <span class="mx-4 text-lg font-normal">
            Files
          </span>
          <span class="flex-grow text-right" />
        </Link>
        <Link
          v-if="$page.props.shared.user.is_admin"
          class="hover:text-gray-800 hover:bg-gray-100 flex items-center my-3 p-3 lg:my-4 transition-colors duration-200 text-gray-600 rounded-lg"
          :class="{'bg-gray-100': $page.component.startsWith('Users')}"
          :href="route('users.index')"
        >
          <vue-feather
            type="users"
            class="ml-3"
          />
          <span class="mx-4 text-lg font-normal">
            Users
          </span>
          <span class="flex-grow text-right" />
        </Link>
        <Link
          class="w-full hover:text-gray-800 hover:bg-gray-100 flex items-center my-3 p-3 lg:my-4 transition-colors duration-200  text-gray-600 rounded-lg "
          type="button"
          as="button"
          method="post"
          :href="route('logout')"
        >
          <vue-feather
            type="log-out"
            class="ml-3"
          />
          <span class="mx-4 text-lg font-normal">
            Logout
          </span>
          <span class="flex-grow text-right" />
        </Link>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>