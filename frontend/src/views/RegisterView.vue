<template>
  <container-component>
    <div
      class="d-flex flex-column align-items-center justify-content-center p-2 mx-auto"
    >
      <h1>Register</h1>
      <form class="form-container flex-grow-1 d-flex flex-column">
        <div class="form-outline mb-4">
          <input-component name="name" label="Name" />
        </div>
        <div class="form-outline mb-4">
          <input-component name="email" label="Email" field-type="email" />
        </div>
        <div class="form-outline mb-4">
          <input-component
            name="password"
            label="Password"
            field-type="password"
          />
        </div>
        <div class="form-outline mb-4">
          <input-component
            name="confirmed_password"
            label="Confirm password"
            field-type="password"
          />
        </div>
        <div class="align-self-baseline">
          <button-component button-type="submit">Sign up</button-component>
        </div>
      </form>
    </div>
  </container-component>
</template>
<script>
import { defineComponent } from "vue";
import InputComponent from "@/components/UI/Input/InputComponent";
import ButtonComponent from "@/components/UI/Button/ButtonComponent";
import ContainerComponent from "@/components/Container/ContainerComponent";

export default defineComponent({
  name: "RegisterView",
  components: { ContainerComponent, ButtonComponent, InputComponent },
});
</script>
<style type="scss">
.form-container {
  width: 40%;
}
</style>
