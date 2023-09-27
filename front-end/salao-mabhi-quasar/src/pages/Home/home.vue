<template>
  <q-page padding>
    <div class="q-pa-md" style="max-width: 350px">
        <list-menu />
    </div>
  </q-page>
</template>

<script>
import ListMenu from 'src/components/Menu/ListMenu.vue'

export default {
  name: 'HomePage',
  components: {
    ListMenu
  },
  setup () {
    return {}
  }
}
</script>
