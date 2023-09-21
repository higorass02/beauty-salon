<template>
  <q-page padding>
    <q-table
      title="Treats"
      :rows="posts"
      :columns="columns"
      row-key="name"
    />
  </q-page>
</template>

<script>
import { defineComponent, onMounted, ref } from 'vue'
import { api } from 'boot/axios'

export default defineComponent({
  name: 'IndexPage',
  setup () {
    const posts = ref([])
    const columns = [
      { name: 'id', field: 'id', label: 'Id', sortable: true, align: 'left' },
      { name: 'title', field: 'title', label: 'Titulo', sortable: true, align: 'left' },
      { name: 'author', field: 'author', label: 'Autor', sortable: true, align: 'left' }
    ]

    onMounted(() => {
      getPosts()
    })

    const getPosts = async () => {
      try {
        const response = await api.get('posts')
        posts.value = response.data
      } catch (error) {
        console.log(error)
      }
    }

    return {
      posts,
      columns
    }
  }
})
</script>
