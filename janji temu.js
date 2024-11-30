document.addEventListener('DOMContentLoaded', function() {
    const serviceDropdown = document.getElementById('service');
    const doctorDropdown = document.getElementById('doctor');
  
    // Daftar dokter berdasarkan layanan
    const doctorsByService = {
      poli_anak: ['Dr. Jasmine Cooper - Spesialis Anak'],
      poli_bedah: ['Dr. David Brown - Spesialis Bedah Ortopedi'],
      poli_kulit_dan_kelamin: ['Dr. Linda Davis - Spesialis Dermatologi'],
      poli_tht: ['Dr. Sarah Williams - Spesialis THT'],
      poli_penyakit_dalam: ['Dr. Michael Lee - Spesialis Penyakit Dalam'],
      poli_ginekologi: ['Dr. Jennifer Clark - Spesialis Ginekologi']
    };
  
    serviceDropdown.addEventListener('change', function () {
      const selectedService = serviceDropdown.value;
      doctorDropdown.innerHTML = '<option value="">Pilih dokter</option>';
  
      if (selectedService && doctorsByService[selectedService]) {
        doctorsByService[selectedService].forEach(doctor => {
          const option = document.createElement('option');
          option.value = doctor;
          option.textContent = doctor;
          doctorDropdown.appendChild(option);
        });
      }
    });
  
    const form = document.getElementById('appointmentForm');
    const successMessage = document.getElementById('successMessage');
  
    form.addEventListener('submit', function (event) {
      event.preventDefault(); 
      successMessage.style.display = 'block';
      form.reset();
      doctorDropdown.innerHTML = '<option value="">Pilih layanan terlebih dahulu</option>';
    });
  });