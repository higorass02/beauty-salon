<template>
  <q-page padding>
    <div class=" text-white q-pa-sm">
      <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
        <div class="q-pa-sm">
          <p class="text-h6 text-primary">Nome do Cliente</p>
          <q-input
            filled
            v-model="nameClient"
            stack-label
          />
        </div>

        <div class="q-pa-sm">
          <p class="text-h6">Data do Atendimento</p>
          <div class="q-gutter-md row items-start">
            <q-date
              v-model="date"
              mask="YYYY-MM-DD HH:mm"
              color="primary"
              text-color="white"
              dark
            />
            <q-time
              v-model="date"
              mask="YYYY-MM-DD HH:mm"
              color="primary"
              text-color="white"
              dark
            />
          </div>
        </div>
        <div align="right">
          <q-btn label="Limpar" type="reset" color="primary" flat class="q-ml-sm" />
          <q-btn label="Consultar" type="submit" color="primary" />
        </div>
      </q-form>
    </div>
  </q-page>
</template>

<script>
import { ref } from 'vue'
export default {
  name: 'HomePage',
  components: {},
  setup () {
    const date = ref('2023-10-03')
    const nameClient = ref('')
    const onSubmit = () => {
      window.location.href = '/customer'
    }
    const onReset = () => {
      console.log('reset')
    }
    return {
      date,
      nameClient,
      onSubmit,
      onReset
    }
  }
}
</script>
