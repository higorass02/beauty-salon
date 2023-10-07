<template>
  <q-page padding>
    <div align="center">
      <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md q-pa-md">
        <q-input
          filled
          v-model="form.name"
          label="Nome do funcionário"
          hint="Nome do funcionário"
          lazy-rules
          :rules="[
            (val) => (val && val.length > 0) || 'Por favor entre com o Nome do funcionário'
          ]"
        />

        <q-input
          filled
          type="email"
          v-model="form.email"
          label="E-mail"
          lazy-rules
          :rules="[
            (val) => (val !== null && val !== '') || 'Por favor entre com o E-mail'
          ]"
        />

        <div class="col-lg-12 q-gutter-sm">
          <q-btn
            label="Salvar"
            color="primary"
            class="float-right"
            icon="save"
            type="submit"
          />
          <q-btn label="Cancelar" type="reset" color="red" class="float-right" />
        </div>
      </q-form>
    </div>
  </q-page>
</template>

<script>
import { ref, onMounted } from 'vue'
import { useQuasar } from 'quasar'
import employeeService from 'src/services/employees.js'
import { useRoute } from 'vue-router'

export default {
  name: 'EditEmployeePage',
  setup () {
    const $q = useQuasar()
    const route = useRoute()
    const { findOne, update } = employeeService()
    const form = ref({
      id: 0,
      name: '',
      email: ''
    })

    $q.loading.show({
      message: 'carregando dados!'
    })

    const onReset = (form) => {
      form.value.name = ''
      form.value.email = ''
    }

    onMounted(async () => {
      form.value.id = route.params.id ?? 0
      const data = await findOne(route.params.id)
      const dataClient = data.data
      form.value.name = dataClient.name
      form.value.email = dataClient.email
      $q.loading.hide()
    })

    const onSubmit = async () => {
      $q.loading.show({
        message: 'Editando funcionário na base de dados ...'
      })
      try {
        await update(form.value)
        $q.loading.hide()
        $q.notify({
          color: 'green-3',
          textColor: 'white',
          icon: 'check',
          message: 'funcionário editado com sucesso!'
        })
        setTimeout(() => {
          window.location.href = '/employee'
        }, 500)
      } catch (error) {
        console.log(error)
        $q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'check',
          message: 'Erro ao cadastrar o funcionário'
        })
      }
    }

    return {
      form,
      onSubmit,
      onReset
    }
  }
}
</script>
