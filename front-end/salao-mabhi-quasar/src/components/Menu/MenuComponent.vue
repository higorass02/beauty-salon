<template>
  <q-header elevated>
    <q-toolbar>
      <q-btn flat dense round icon="menu" aria-label="Menu" @click="toggleLeftDrawer" />

      <q-toolbar-title> Quasar App </q-toolbar-title>
    </q-toolbar>
  </q-header>

  <q-drawer v-model="leftDrawerOpen" show-if-above bordered>
    <q-list>
      <q-item-label header> Menus </q-item-label>
      <EssentialLink v-for="link in essentialLinks" :key="link.title" v-bind="link" />
    </q-list>
  </q-drawer>
</template>
<script>
import { ref } from 'vue'
import EssentialLink from 'src/components/EssentialLink.vue'

const linksList = [
  {
    title: 'Home',
    caption: '',
    icon: 'home',
    route: { name: 'homePage' }
  },
  {
    title: 'Clientes',
    caption: '',
    icon: 'people',
    route: { name: 'customer' }
  },
  {
    title: 'Serviços',
    caption: '',
    icon: 'work',
    route: { name: 'service' }
  },
  {
    title: 'Funcionários',
    caption: '',
    icon: 'assignment_ind',
    route: { name: 'employee' }
  }
]

export default {
  name: 'MenuComponent',
  components: {
    EssentialLink
  },

  setup () {
    const leftDrawerOpen = ref(false)

    return {
      essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
      }
    }
  }
}
</script>
