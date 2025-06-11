<script setup>
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import { useRouter, useRoute } from 'vue-router';

const form = reactive({
    breedName: '',
    description: '',
    breedSize: '',
    image: ''
})

const router = useRouter();
const route = useRoute();
const editMode = ref(false);

onMounted(() => {
  if (route.name === 'dogs.edit') {
    editMode.value = true;
    getDog();
  }
});

const getDog = async () => {
  let response = await axios.get(`/api/dogs/${route.params.id}/edit`);
  form.breedName = response.data.dog.breedName;
  form.description = response.data.dog.description;
  form.breedSize = response.data.dog.breedSize;
  form.image = response.data.dog.image;
};

const getImage = () => {
  let image = "/upload/no-image.jpg";
  if (form.image) {
    if (form.image.indexOf("base64") !== -1) {
      image = form.image;
    } else {
      image = "/upload/" + form.image;
    }
  }
  return image;
};

const handleFileChange = (e) => {
  let file = e.target.files[0];
  let reader = new FileReader();
  reader.onloadend = () => {
    form.image = reader.result;
  };
  reader.readAsDataURL(file);
};

const handleSave = (values, actions) => {
  if(editMode.value){
    updateDog(values, actions);
  }
  else{
    createDog(values, actions);
  }
};

const createDog = (values, actions) =>{
  axios.post('/api/dogs', form)
    .then(response => {
      router.push('/');
    })
    .catch(error => {
      console.error(error.response.data);
    });
}

const updateDog = (values, actions) => {
  axios.put(`/api/dogs/${route.params.id}`, form) // Notice the backticks for template literals
    .then(response => {
      router.push('/');
    })
    .catch(error => {
      console.error(error.response.data);
    });
};

</script>

<template>
  <div class="form-wrapper">
    <h2 class="text-center mb-5 title">
      <span v-if="editMode">Edit Dog</span>
      <span v-else>Add New Dog</span>
    </h2>

    <form @submit.prevent="handleSave" class="form-container p-5">
      <div class="form-group mb-4">
        <label for="breedName" class="form-label">Dog Breed Name</label>
        <input
          v-model="form.breedName"
          type="text"
          id="breedName"
          class="form-control"
          placeholder="Enter the breed name"
          required
        />
      </div>

      <div class="form-group mb-4">
        <label for="description" class="form-label">Description</label>
        <textarea
          v-model="form.description"
          id="description"
          class="form-control"
          rows="4"
          placeholder="Describe the breed"
          required
        ></textarea>
      </div>

      <div class="form-group mb-4">
        <label for="breedSize" class="form-label">Size Category</label>
        <select
          v-model="form.breedSize"
          id="breedSize"
          class="form-control"
          required
        >
          <option value="">Select size category</option>
          <option value="Small Breed">Small Breed</option>
          <option value="Medium Breed">Medium Breed</option>
          <option value="Large Breed">Large Breed</option>
        </select>
      </div>

      <div class="form-group mb-5">
        <label for="image" class="form-label">Upload Image</label>
        <img :src="getImage()" class="mb-3">
        <input
          type="file"
          @change="handleFileChange"
          id="image"
          class="form-control"
        />
      </div>

      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-submit shadow-lg">
          <span v-if="editMode">Edit Dog</span>
          <span v-else>Add Dog</span>
        </button>
      </div>
    </form>

    <!-- Success message -->
    <div v-if="successMessage" class="alert alert-success mt-4 text-center">
      {{ successMessage }}
    </div>
  </div>
</template>

<style scoped>
/* Form Wrapper Styling */
.form-wrapper {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

/* Typography */
.title {
  font-size: 32px;
  font-weight: bold;
  color: #0d0d0d; /* Black color */
}

.form-label {
  font-weight: 500;
  font-size: 16px;
  color: #333333;
}

/* Form Container */
.form-container {
  background-color: #f9f9f9; /* Light Gray background */
  border: 2px solid #e6e6e6; /* Light Gray border */
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

/* Input Styling */
.form-control {
  padding: 12px;
  font-size: 15px;
  border-radius: 8px;
  border: 1px solid #e6e6e6; /* Light Gray border */
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
  transition: all 0.3s ease;
}

.form-control:focus {
  border-color: #0078d0; /* Olympic Blue */
  box-shadow: 0 0 8px rgba(0, 120, 208, 0.25);
}

textarea.form-control {
  resize: none;
}

/* Button Styling */
.btn-submit {
  background-color: #0078d0; /* Olympic Blue */
  border: none;
  color: white;
  padding: 12px 40px;
  font-size: 16px;
  border-radius: 50px;
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
  background-color: #005fa3; /* Darker Blue */
}

/* Alert Box for Success */
.alert {
  font-size: 16px;
  color: #0d0d0d;
  background-color: #00a651; /* Olympic Green */
  border: none;
  border-radius: 8px;
  padding: 12px;
  margin-top: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Elevated shadow */
}
</style>
