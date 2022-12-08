<template>
  <container-component>
    <div
      class="d-flex flex-column align-items-center justify-content-center p-2 mx-auto"
    >
      <h1>Login</h1>
      <form
        @submit.prevent="handleSubmit"
        class="form-container flex-grow-1 d-flex flex-column"
      >
        <div class="form-outline mb-4">
          <input-component
            name="email"
            label="Email"
            field-type="email"
            v-model="form.email"
          />
        </div>
        <div class="form-outline mb-4">
          <input-component
            name="password"
            label="Password"
            field-type="password"
            v-model="form.password"
          />
        </div>
        <div class="align-self-baseline">
          <button-component button-type="submit">Sign in</button-component>
        </div>
      </form>
      <div class="pt-2" v-if="store.state.user.errors">
        <form-error-component :error="store.state.user.errors" />
      </div>
    </div>
  </container-component>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import ContainerComponent from "../components/Container/ContainerComponent.vue";
import InputComponent from "../components/UI/Input/InputComponent.vue";
import ButtonComponent from "../components/UI/Button/ButtonComponent.vue";
import { useStore } from "vuex";
import FormErrorComponent from "@/components/FormError/FormErrorComponent.vue";

export default defineComponent({
  name: "LoginView",
  components: {
    FormErrorComponent,
    ButtonComponent,
    InputComponent,
    ContainerComponent,
  },
  data: function () {
    return {
      store: useStore(),
      form: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    handleSubmit() {
      const formData = new FormData();
      formData.append("email", this.form.email);
      formData.append("password", this.form.password);
      this.store.dispatch("login", formData);
    },
    isSaveUser(): boolean {
      return !!this.store.state.user.id;
    },
  },
});
</script>

<style scoped></style>
