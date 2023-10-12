<template>
    <div class="container mt-5">
        <!--Card de consulta-->
        <div class="row justify-content-center" v-if="!showDetail">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="mb-3 text-center">
                                <label for="code" class="form-label"
                                    >Código pedido</label
                                >

                                <input
                                    type="text"
                                    class="form-control"
                                    id="code"
                                    required
                                    v-model="formData.code"
                                />
                            </div>
                            <div class="mb-3 text-center">
                                <label for="type_document" class="form-label"
                                    >Tipo de documento</label
                                >
                                <select
                                    class="form-select"
                                    id="opciones"
                                    required
                                    v-model="formData.type_document"
                                >
                                    <option value="" disabled>
                                        Selecciona una opción
                                    </option>
                                    <option
                                        v-for="(opcion, index) in opciones"
                                        :value="opcion"
                                        :key="index"
                                    >
                                        {{ opcion }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3 text-center">
                                <label for="document" class="form-label"
                                    >Documento</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="document"
                                    required
                                    v-model="formData.document"
                                />
                            </div>

                            <div class="d-flex justify-content-center">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-rounded"
                                >
                                    Consultar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Card detalle de pedido consultado-->
        <div class="row justify-content-center" v-else>
            <div class="col-md-6">
                <div class="card card-detail">
                    <div class="card-body">
                        <form>
                            <div class="mb-3 text-white">
                                <label class="form-label"
                                    ><b>Código pedido:</b>
                                    {{ order.code }}</label
                                >
                            </div>
                            <div class="mb-3 text-white">
                                <label class="form-label"
                                    ><b>Cliente:</b> {{ order.name }}</label
                                >
                            </div>
                            <div class="mb-3 text-white">
                                <label class="form-label"
                                    ><b>Dirección de entrega:</b>
                                    {{ order.delivery_address }}</label
                                >
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre de producto</th>
                                        <th scope="col">Ref.</th>
                                        <th scope="col">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(details, index) in detail"
                                        :key="details.id"
                                    >
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ details.name }}</td>
                                        <td>{{ details.ref }}</td>
                                        <td>{{ details.quantity }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mb-3 text-white">
                                <label class="form-label"
                                    ><b>Estado del pedido:</b>
                                    {{ order.state }}</label
                                >
                            </div>
                            <div class="mb-3 text-white">
                                <label class="form-label"
                                    ><b>Fecha estimada de entrega:</b>
                                    {{ order.delivery_date }}</label
                                >
                            </div>
                            <div class="d-flex justify-content-center">
                                <button
                                    type="button"
                                    class="btn btn-danger btn-rounded text-white mx-2" @click="showDetail = false"
                                >
                                    Cerrar
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-primary btn-rounded mx-2" @click="showDetail = false"
                                >
                                    Nueva consulta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import axios from "axios";

const showDetail = ref(false);
const opciones = [
    "Tarjeta de identidad",
    "Cédula de ciudadanía",
    "Pasaporte",
    "Cédula de extranjería",
];
const order = ref([]);
const detail = ref([]);
const formData = ref({
    code: "",
    type_document: "",
    document: "",
});
const submitForm = () => {
    axios
        .get(
            "/orders?code=" +
                formData.value.code +
                "&type=" +
                formData.value.type_document +
                "&document=" +
                formData.value.document
        )
        .then((response) => {
            if (response.data !== "") {
                showDetail.value = true;
                order.value = response.data.order;
                detail.value = response.data.detail;
                formData.value.code = "";
                formData.value.type_document = "";
                formData.value.document = "";

            } else {
                Swal.fire("Atención!", "No existe ningún pedido con esos datos digitados!", "warning");
                showDetail.value = false;
            }
        })
        .catch((error) => {
            console.error(error);
        });
};
</script>

<style scoped>
.btn-rounded {
    border-radius: 20px; /* Ajusta el valor según tu preferencia */
}
.card-detail {
    background-color: #95bcf2;
}
</style>
