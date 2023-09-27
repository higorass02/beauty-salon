<template>
  <q-page
    class="bg-light-green window-height window-width row justify-center items-center"
  >
    <div class="column">
      <div class="row">
        <h5 class="text-h5 text-white q-my-md">Company & Co</h5>
      </div>
      <div class="row">
        <q-card square bordered class="q-pa-lg shadow-1">
          <q-form class="q-gutter-md" @submit="onSubmit" v-model="myForm">
            <q-card-section>
              <q-input
                square
                filled
                clearable
                v-model="email"
                type="email"
                label="email"
                lazy-rules
                :rules="[ val => val && val.length > 0 || 'Please type something']"
              />
              <q-input
                square
                filled
                clearable
                v-model="password"
                type="password"
                label="password"
                :rules="[ val => val !== null && val !== '' || 'Please type your password' ]"
              />
            </q-card-section>
            <q-card-actions class="q-px-md">
              <q-btn
                unelevated
                color="light-green-7"
                size="lg"
                class="full-width"
                label="Login"
                type="submit"
              />
            </q-card-actions>
          </q-form>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { ref } from 'vue'
import { useQuasar } from 'quasar'

export default {
  props: {},
  name: 'LoginPage',
  setup () {
    const $q = useQuasar()
    const myForm = ref(null)
    const email = ref('')
    const password = ref('')

    return {
      onSubmit () {
        myForm.value.validate().then((success) => {
          if (success) {
            console.log(email.value)
            console.log(password.value)
            $q.notify({
              color: 'red-5',
              textColor: 'white',
              icon: 'warning',
              message: 'You need to accept the license and terms first'
            })
          } else {
            $q.notify({
              color: 'green-4',
              textColor: 'white',
              icon: 'cloud_done',
              message: 'Submitted'
            })
          }
        })
      }
    }
  }
}
</script>

<style>
.q-card {
  width: 360px;
}
</style>
