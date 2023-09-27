<template>
  <q-list bordered separator >
    <q-item clickable v-ripple>
      <q-item-section>
        <a href="/home">
            <q-item-label overline>Home</q-item-label>
        </a>
      </q-item-section>
    </q-item>
    <q-item clickable v-ripple>
        <q-item-section>
        <a href="/customer">
            <q-item-label overline>Cliente</q-item-label>
        </a>
      </q-item-section>
    </q-item>
  </q-list>
</template>
<script>
export default {
}
</script>
