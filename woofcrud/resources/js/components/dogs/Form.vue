<script setup>
import { reactive } from 'vue';

const form = reactive({

    breedName: '',
    description: '',
    size: '',
    imgSrc: ''
})

const getImage = () => {
    let image = "/upload/no-image.jpg";
    if (form.image) {
        if(form.image.indexOF("base64") !== -1) {
            image = form.image;
        } else {
            image = "/upload/" + form.image;
        }
    }
    return image;
}

const handleFileChange = (e) => {
    let file = e.target.files[0];
    let reader = new FileReader();
    reader.onloadend = (file) => {
        form.image = reader.result;
    };
    reader.readAsDataURL(file);
}

    const handleSave = () => {
      axios.post('/api/dogs', form)
    };
</script>
<template>
    <div class="form-wrapper">
      <h2 class="text-center mb-5 title">Add a New Dog</h2>
  
      <form @submit.prevent="handleSubmit" class="form-container p-5">
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
          <label for="size" class="form-label">Size Category</label>
          <select
            v-model="form.size"
            id="size"
            class="form-control"
            required
          >
            <option value="">Select size category</option>
            <option value="Small Breeds">Small Breeds</option>
            <option value="Medium Breeds">Medium Breeds</option>
            <option value="Large Breeds">Large Breeds</option>
          </select>
        </div>
  
        <div class="form-group mb-5">
          <label for="image" class="form-label">Upload Image</label>
          <img :src="getImage()"> <!-- Display the uploaded image -->
          <input
            type="file"
            @change="handleFileChange"
            id="image"
            class="form-control"
          />
        </div>
  
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-submit shadow-lg" @click="handleSave">Add Dog</button>
        </div>
      </form>
  
      <!-- Success message -->
      <div v-if="successMessage" class="alert alert-success mt-4 text-center">
        {{ successMessage }}
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          breedName: '',
          description: '',
          size: '',
          imgSrc: ''
        },
        successMessage: '',
      };
    },
    methods: {
      handleSubmit() {
        if (this.form.breedName && this.form.description && this.form.size) {
          const newDog = {
            breedID: Date.now(),
            breedName: this.form.breedName,
            description: this.form.description,
            size: this.form.size,
            imgSrc: this.form.imgSrc || 'upload/default.jpg',
          };
  
          this.successMessage = `Successfully added ${newDog.breedName} to ${newDog.size}!`;
  
          // Reset form
          this.form.breedName = '';
          this.form.description = '';
          this.form.size = '';
          this.form.imgSrc = '';
        } else {
          this.successMessage = '';
        }
      },
      handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = e => {
            this.form.imgSrc = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      },
    },
  };
  </script>
  
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
  