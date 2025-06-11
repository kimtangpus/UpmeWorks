<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
let dogs = ref([]);

let searchQuery = ref('');

onMounted(async () => {
  await getDogs(); 
});

watch(searchQuery, () => {
  getDogs(); 
}); 

const newDog = () => {
  router.push('/dogs/create'); 
};

const ourImage = (image) => {
  return "/upload/" + image; 
};

const getDogs = async () => {
  try {
    let response = await axios.get('/api/dogs?&searchQuery='+searchQuery.value);
    dogs.value = response.data.dogs;
  } catch (error) {
    console.error('Error fetching dogs:', error);
  }
};
const onEdit = (id) => {
  router.push(`/dogs/${id}/edit`); 
};
const dogDelete = async (id) => {
  if (confirm('Are you sure you want to delete this dog?')) {
    try {
      await axios.delete(`/api/dogs/${id}`);     
      await getDogs();
    } catch (error) {
      console.error('Error deleting dog:', error);
    }
  }
};

</script>

<template>
  <div>
    <h1 class="text-center mt-5">Dogs</h1>
  </div>

  <!-- Section: Home -->
  <section class="home p-5 m-10" id="home" style="background-color: #f8f9fa;">
    <div class="container p-5">
      <div class="row align-items-center justify-content-center text-center px-5">
        <div class="col-md-6 pb-5">
          <h1 class="display-4 fw-bold mb-4">
            <span style="color: #0078D0;">Welcome to Woofopedia</span>
          </h1>
          <p class="lead mb-4">
            <span style="color: #00A651;">Discover and learn about your favorite dog breeds</span>
          </p>
          <a href="#doggos" class="btn btn-lg btn-primary rounded-pill px-5 py-3 shadow-lg">Explore</a>
        </div>
        <div class="col-md-6">
          <img src="https://i.postimg.cc/FHFQcVwG/dogs.jpg" class="img-fluid rounded-5 shadow-lg mx-auto d-block" alt="Dogs" />
        </div>
      </div>
    </div>
  </section>

  
  <section id="doggos" class="p-5 m-10">
    <div class="container">
      <h1 class="text-center mb-5" style="font-size: 45px; color: #0078D0;">Dog Breeds</h1>

      <form @submit.prevent="searchBreeds" class="d-flex justify-content-center mb-5">
        <input
          v-model="searchQuery"
          class="form-control w-50 me-3 rounded-pill shadow-sm px-4 py-3"
          type="text"
          name="search"
          placeholder="Search for breeds"
          aria-label="Search"
        />
        <button class="btn btn-success rounded-pill px-5 py-3 shadow-lg" type="submit">Search</button>
        <button class="btn btn-primary text-center rounded-pill px-5 py-3 shadow-lg" @click="newDog">
          Add a Dog
        </button>
      </form>

     
      <div class="container">
        <div class="row justify-content-center">
          <div class="d-flex flex-row flex-wrap justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4" v-for="dog in dogs" :key="dog.id">
              <div class="card shadow-lg border-0 h-100" style="background-color: #f8f9fa;">
                <img class="card-img-top rounded-top img-fluid" :src="ourImage(dog.image)" alt="Dog" />
                <div class="card-body text-center rounded-bottom p-4" style="background-color: #0078D0; color: #fff;">
                  <h3 class="card-title mb-3">{{ dog.breedName }}</h3>
                  <p class="desc mb-4">{{ dog.description }}</p>
                  <p class="desc mb-4">{{ dog.breedSize }}</p>
                  <button class="btn btn-warning rounded-pill me-2" @click="onEdit(dog.id)">
                    Edit
                  </button>
                  <button class="btn btn-danger rounded-pill" @click="dogDelete(dog.id)">
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



    </div>
  </section>
</template>


