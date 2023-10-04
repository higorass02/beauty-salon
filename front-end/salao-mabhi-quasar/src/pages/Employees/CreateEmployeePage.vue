<template>
  <q-page padding>
    <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md q-pa-md">
      <q-input
        filled
        v-model="form.name"
        label="Nome do Funcionário"
        hint="Nome do Funcionário"
        lazy-rules
        :rules="[
          (val) => (val && val.length > 0) || 'Por favor entre com o Nome do Funcionário'
        ]"
      />

      <q-input
        filled
        type="email"
        v-model="form.email"
        label="E-Mail"
        lazy-rules
        :rules="[(val) => (val !== null && val !== '') || 'Por favor entre com o E-mail']"
      />

      <div class="col-lg-12 q-gutter-sm">
        <q-btn
          label="Salvar"
          color="primary"
          class="float-right"
          icon="save"
          type="submit"
        />
        <q-btn label="Cancelar" type="reset" color="red" class="float-right"/>
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { ref } from 'vue'
import { useQuasar } from 'quasar'
import employeeService from 'src/services/employees.js'

export default {
  name: 'CreateEmployeePage',
  setup () {
    const $q = useQuasar()
    const { post } = employeeService()
    const form = ref({
      name: '',
      email: ''
    })

    const onReset = (form) => {
      form.value.name = ''
      form.value.email = ''
    }

    const onSubmit = async () => {
      $q.loading.show({
        message: 'Inserindo funcionário na base de dados...'
      })
      try {
        await post(form.value)
        $q.loading.hide()
        $q.notify({
          color: 'green-3',
          textColor: 'white',
          icon: 'check',
          message: 'Funcionário Cadastrado com sucesso'
        })
        $q.dialog({
          title: 'Novo Cadastro ?',
          message: 'Deseja inserir outro funcionário ?',
          ok: {
            push: true,
            label: 'Sim'
          },
          cancel: {
            push: true,
            color: 'negative',
            label: 'Não'
          },
          persistent: true
        })
          .onOk(async () => {
            onReset(form)
          })
          .onCancel(() => {
            window.location.href = '/employee'
          })
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
