<?php include 'header.php' ?>

<!-- Hero Section -->
<section class="pt-20 min-h-screen flex items-center bg-gradient-to-br from-slate-50 to-gray-100">
  <div class="container mx-auto px-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <!-- Text Content -->
      <div class="text-center lg:text-left order-2 lg:order-1">
        <p class="text-indigo-600 font-medium text-lg mb-4 animate-fade-in">Hello...</p>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6 leading-tight animate-slide-up">
          I am <span class="text-indigo-600">Nica Angelene</span> M. Comia, 21 Y/O
        </h1>
        <p class="text-xl md:text-2xl text-gray-600 mb-8 animate-slide-up-delay">
          and I'm a <span class="font-semibold text-indigo-600">Photographer</span>
        </p>
        <a href="inquire.php" class="inline-block bg-indigo-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl animate-bounce-in">
          <i class="fas fa-camera mr-2"></i>HIRE ME!
        </a>
        <p class="text-2xl font-bold text-gray-800 mt-8 italic animate-fade-in-delay">
          Click by Nica
        </p>
      </div>
      
      <!-- Image Section -->
      <div class="order-1 lg:order-2 flex justify-center">
        <div class="relative">
          <!-- Main Image -->
          <div class="relative z-10 transform hover:scale-105 transition-transform duration-500">
            <img src="pic2.png" alt="Nica - Photographer" class="w-80 h-80 md:w-96 md:h-96 object-cover rounded-2xl shadow-2xl grayscale hover:grayscale-0 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-2xl"></div>
          </div>
          
          <!-- Decorative Elements -->
          <div class="absolute -top-4 -right-4 w-20 h-20 bg-indigo-500/20 rounded-full blur-xl animate-pulse"></div>
          <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-purple-500/20 rounded-full blur-xl animate-pulse delay-1000"></div>
          
          <!-- Mirror Effect (Optional) -->
          <div class="absolute top-4 left-4 w-full h-full opacity-10 transform rotate-3 scale-95 -z-10">
            <img src="pic2.png" alt="Photographer Mirror" class="w-full h-full object-cover rounded-2xl grayscale">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Why Choose Click by Nica?</h2>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">Capturing moments that matter with professional expertise and creative vision</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="text-center p-6 rounded-xl hover:shadow-lg transition-shadow duration-300">
        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-eye text-indigo-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Creative Vision</h3>
        <p class="text-gray-600">Unique perspective and artistic approach to every shoot</p>
      </div>
      
      <div class="text-center p-6 rounded-xl hover:shadow-lg transition-shadow duration-300">
        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-heart text-indigo-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Personal Touch</h3>
        <p class="text-gray-600">Building connections to capture authentic emotions</p>
      </div>
      
      <div class="text-center p-6 rounded-xl hover:shadow-lg transition-shadow duration-300">
        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-clock text-indigo-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Timely Delivery</h3>
        <p class="text-gray-600">Professional service with quick turnaround times</p>
      </div>
    </div>
  </div>
</section>

<style>
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  
  @keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }
  
  @keyframes bounceIn {
    from { opacity: 0; transform: scale(0.3); }
    to { opacity: 1; transform: scale(1); }
  }
  
  .animate-fade-in {
    animation: fadeIn 1s ease-out;
  }
  
  .animate-slide-up {
    animation: slideUp 1s ease-out 0.2s both;
  }
  
  .animate-slide-up-delay {
    animation: slideUp 1s ease-out 0.4s both;
  }
  
  .animate-bounce-in {
    animation: bounceIn 1s ease-out 0.6s both;
  }
  
  .animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.8s both;
  }
</style>

<?php include 'footer.php' ?>