<template>
  <q-layout view="lHh Lpr lFf">
    <MenuComponentVue/>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import MenuComponentVue from 'src/components/Menu/MenuComponent.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  watch: {
  },
  name: 'HomeLayout',
  components: {
    MenuComponentVue
  },
  setup () {
    return {}
  }
})
</script>
