document.addEventListener('DOMContentLoaded', function() {
    const poliSelect = document.getElementById('poli');
    const dokterSelect = document.getElementById('dokter');
    const counterDisplay = document.getElementById('currentNumber');
    const takeNumberBtn = document.getElementById('takeNumberBtn');
    const queueList = document.getElementById('queueList');
    const resetBtn = document.getElementById('resetBtn');
  
    const doctorsByPoli = {
      poli_anak: ['Dr. Jasmine Cooper - Spesialis Anak'],
      poli_bedah: ['Dr. David Brown - Spesialis Bedah Ortopedi'],
      poli_kulit_dan_kelamin: ['Dr. Linda Davis - Spesialis Dermatologi'],
      poli_tht: ['Dr. Sarah Williams - Spesialis THT'],
      poli_penyakit_dalam: ['Dr. Michael Lee - Spesialis Penyakit Dalam'],
      poli_ginekologi: ['Dr. Jennifer Clark - Spesialis Ginekologi']
    };
  
    let currentNumber = {}; // Menyimpan nomor antrian per poli
    loadQueueData(); // Muat data antrian dari localStorage
  
    poliSelect.addEventListener('change', function() {
      const selectedPoli = poliSelect.value;
      updateDoctorList(selectedPoli);
      updateCounterDisplay(selectedPoli);
    });
  
    dokterSelect.addEventListener('change', function() {
      const selectedPoli = poliSelect.value;
      updateCounterDisplay(selectedPoli);
    });
  
    takeNumberBtn.addEventListener('click', function() {
      const selectedPoli = poliSelect.value;
      if (selectedPoli) {
        currentNumber[selectedPoli] = (currentNumber[selectedPoli] || 0) + 1;
        updateCounterDisplay(selectedPoli);
        updateQueueList();
        saveQueueData();
      }
    });
  
    resetBtn.addEventListener('click', function() {
      currentNumber = {};
      counterDisplay.textContent = 0;
      updateQueueList();
      saveQueueData();
    });
  
    function updateDoctorList(selectedPoli) {
      dokterSelect.innerHTML = '<option value="">Pilih Dokter</option>';
      if (selectedPoli && doctorsByPoli[selectedPoli]) {
        doctorsByPoli[selectedPoli].forEach(doctor => {
          const option = document.createElement('option');
          option.value = doctor;
          option.textContent = doctor;
          dokterSelect.appendChild(option);
        });
      }
    }
  
    function updateCounterDisplay(selectedPoli) {
      if (selectedPoli) {
        counterDisplay.textContent = currentNumber[selectedPoli] || 0;
      } else {
        counterDisplay.textContent = 0;
      }
    }
  
    function updateQueueList() {
      queueList.innerHTML = '';
      for (const poli in currentNumber) {
        const listItem = document.createElement('li');
        listItem.textContent = `Poli ${poli}: ${currentNumber[poli]}`;
        queueList.appendChild(listItem);
      }
    }
  
    function saveQueueData() {
      localStorage.setItem('queueData', JSON.stringify(currentNumber));
    }
  
    function loadQueueData() {
      const savedData = localStorage.getItem('queueData');
      if (savedData) {
        currentNumber = JSON.parse(savedData);
        updateQueueList();
      }
    }
  });
