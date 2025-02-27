<script setup>
  import { useRouter } from 'vue-router';

  const router = useRouter();

  const newDog = () => {
    router.push('/dogs/create');
  };
</script>

<template>
  <div>
    <h1 class="text-center mt-5">Dogs</h1>
  </div>

  <!-- Section: Home -->
  <section class="home py-5" id="home" style="background-color: #f8f9fa;">
    <div class="container">
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

  <!-- Section: Dog Sizes -->
  <section id="doggos" class="py-5">
    <div class="container">
      <h1 class="text-center mb-5" style="font-size: 45px; color: #0078D0;">Dog Sizes</h1>

      <!-- Search Bar -->
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

      <!-- Displaying Dog Breeds -->
      <div v-for="size in filteredSizes" :key="size.sizeID" class="mb-5">
  <h2 v-if="size.dogs.length" class="text-center mt-5 mb-4" style="font-size: 35px; color: #F0282D;">{{ size.sizeName }}</h2>

  <!-- Row to align the cards horizontally -->
  <div class="row justify-content-center">
    <div v-for="dog in size.dogs" :key="dog.breedID" class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
      <div class="card shadow-lg border-0 h-100" :style="{ backgroundColor: dog.backgroundColor }">
        <img class="card-img-top rounded-top" :src="dog.imgSrc" :alt="dog.breedName" />
        <div class="card-body text-center rounded-bottom p-4" style="background-color: #0078D0; color: #fff;">
          <h3 class="card-title mb-3">{{ dog.breedName }}</h3>
          <p class="desc mb-4">{{ dog.description }}</p>
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-light text-dark btn-sm rounded-pill px-4" @click="editBreed(dog)">Edit</button>
            <button type="button" class="btn btn-danger btn-sm rounded-pill px-4" @click="deleteBreed(dog.breedID)">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

      <!-- Message when no results are found -->
      <div v-if="filteredSizes.every(size => size.dogs.length === 0)" class="text-center">
        <h4>No breeds match your search criteria.</h4>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: '',
      sizes: [
        {
          sizeID: 1,
          sizeName: 'Small Breeds',
          dogs: [
            {
              breedID: 1,
              breedName: 'Shih Tzu',
              description: 'Affectionate and alert, known for their long flowing coat.',
              imgSrc: 'upload/shihtzu.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 2,
              breedName: 'Pomeranian',
              description: 'Lively and bold, this small breed is known for its fluffy coat.',
              imgSrc: 'upload/pomeranian.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 3,
              breedName: 'Chihuahua',
              description: 'Small in size but big in personality.',
              imgSrc: 'upload/chihuahua.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 4,
              breedName: 'Yorkshire Terrier',
              description: 'Known for its silky coat and feisty nature.',
              imgSrc: 'upload/yorkie.jpg',
              backgroundColor: '#f8f9fa',
            },
          ],
        },
        {
          sizeID: 2,
          sizeName: 'Medium Breeds',
          dogs: [
            {
              breedID: 5,
              breedName: 'Beagle',
              description: 'Curious, friendly, and great for families.',
              imgSrc: 'upload/beagle.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 6,
              breedName: 'Cocker Spaniel',
              description: 'Known for its gentle temperament and playful nature.',
              imgSrc: 'upload/CockerSpaniel.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 7,
              breedName: 'Border Collie',
              description: 'Highly intelligent and energetic, often used for herding.',
              imgSrc: 'upload/Bordercollie.jpg',
              backgroundColor: '#f8f9fa',
            },
          ],
        },
        {
          sizeID: 3,
          sizeName: 'Large Breeds',
          dogs: [
            {
              breedID: 8,
              breedName: 'German Shepherd',
              description: 'Confident and courageous, often used in police and military roles.',
              imgSrc: 'upload/german.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 9,
              breedName: 'Rottweiler',
              description: 'Loyal and protective, making them excellent guard dogs.',
              imgSrc: 'upload/rottie.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 10,
              breedName: 'Golden Retriever',
              description: 'Friendly and intelligent, popular for families and service work.',
              imgSrc: 'upload/golden.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 11,
              breedName: 'Great Dane',
              description: 'Gentle giant, known for their large size and friendly nature.',
              imgSrc: 'upload/greatdane.jpg',
              backgroundColor: '#f8f9fa',
            },
            {
              breedID: 12,
              breedName: 'Bulldog',
              description: 'Calm and courageous, known for its distinctive wrinkled face.',
              imgSrc: 'upload/bulldog.jpg',
              backgroundColor: '#f8f9fa',
            },
          ],
        },
      ],
    };
  },
  computed: {
    filteredSizes() {
      const query = this.searchQuery.trim().toLowerCase();
      if (!query) {
        return this.sizes;
      }
      return this.sizes.map(size => {
        const filteredDogs = size.dogs.filter(dog =>
          dog.breedName.toLowerCase().includes(query)
        );
        return { ...size, dogs: filteredDogs };
      });
    },
  },
  methods: {
    addDog() {
      alert('Add Dog button clicked!'); // Placeholder for adding a dog
    },
    editBreed(dog) {
      // Logic for editing the dog breed
    },
    deleteBreed(breedID) {
      // Logic for deleting the dog breed
    },
  },
};
</script>
