<template>
  <q-page padding>
    <q-table title="Treats" :rows="posts" :columns="columns" row-key="name" />
  </q-page>
</template>

<script>
import { defineComponent, onMounted, ref } from 'vue'
import postsService from 'src/services/posts'

export default defineComponent({
  data () {
    return {}
  },
  name: 'IndexPage',
  setup () {
    const posts = ref([])
    const { list } = postsService()
    const columns = [
      {
        name: 'id',
        field: 'id',
        label: 'Id',
        sortable: true,
        align: 'left'
      },
      {
        name: 'title',
        field: 'title',
        label: 'Titulo',
        sortable: true,
        align: 'left'
      },
      {
        name: 'author',
        field: 'author',
        label: 'Autor',
        sortable: true,
        align: 'left'
      }
    ]

    onMounted(() => {
      getPosts()
    })

    const getPosts = async () => {
      try {
        posts.value = await list()
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
