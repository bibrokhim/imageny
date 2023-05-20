<template>
  <Header title="Users" />
  <div class="relative overflow-x-auto">
    <Link :href="route('users.create')">
      <ButtonBase
        class="mb-4"
        type="yellow"
      >
        New user
      </ButtonBase>
    </Link>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Name
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Email
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Images
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Files
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Edit
          </th>
        </tr>
      </thead>
      <tbody>
        <template
          v-for="user in users"
          :key="user.id"
        >
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td
              class="px-6 py-4"
              v-text="user.name"
            />
            <td
              class="px-6 py-4"
              v-text="user.email"
            />
            <td
              class="px-6 py-4"
              v-text="user.images_count"
            />
            <td
              class="px-6 py-4"
              v-text="user.files_count"
            />
            <td class="text-center">
              <Link :href="route('users.edit', user.id)">
                <vue-feather
                  type="edit"
                  size="16"
                  class="ml-3"
                />
              </Link>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import Header from '../Shared/TheHeader.vue';
import { Link } from "@inertiajs/vue3";
import ButtonBase from "../Shared/ButtonBase.vue";

const props = defineProps({
  users: {
    type: Array,
    required: true
  }
}); 

</script>
