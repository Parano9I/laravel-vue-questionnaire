<template>
  <container-component>
    <div
      class="d-flex flex-column align-items-center justify-content-center p-2 mx-auto"
    >
      <h1>Register</h1>
      <form
        @submit.prevent="handleSubmit"
        class="form-container flex-grow-1 d-flex flex-column"
      >
        <div class="form-outline mb-4">
          <input-component name="name" label="Name" v-model="form.name" />
        </div>
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
        <div class="form-outline mb-4">
          <input-component
            name="password_confirmation"
            label="Confirm password"
            field-type="password"
            v-model="form.confirmedPassword"
          />
        </div>
        <div class="align-self-baseline">
          <button-component button-type="submit">Sign up</button-component>
        </div>
        <div class="pt-2" v-if="store.state.user.errors">
          <form-error-component :error="store.state.user.errors" />
        </div>
      </form>
    </div>
  </container-component>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import InputComponent from "@/components/UI/Input/InputComponent.vue";
import ButtonComponent from "@/components/UI/Button/ButtonComponent.vue";
import ContainerComponent from "@/components/Container/ContainerComponent.vue";
import FormErrorComponent from "@/components/FormError/FormErrorComponent.vue";
import { useStore } from "vuex";

export default defineComponent({
  name: "RegisterView",
  components: {
    FormErrorComponent,
    ContainerComponent,
    ButtonComponent,
    InputComponent,
  },
  data() {
    return {
      store: useStore(),
      form: {
        name: "",
        email: "",
        password: "",
        confirmedPassword: "",
      },
    };
  },
  methods: {
    handleSubmit() {
      const formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("email", this.form.email);
      formData.append("password", this.form.password);
      formData.append("password_confirmation", this.form.confirmedPassword);

      this.store.dispatch("userCreate", formData);

      if (this.isSaveUser()) {
        this.$router.push({ name: "home" });
      }
    },
    isSaveUser(): boolean {
      return !!this.store.state.user.id;
    },
  },
});
</script>
<style type="scss">
.form-container {
  width: 40%;
}
</style>
