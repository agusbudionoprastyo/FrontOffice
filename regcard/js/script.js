// document.addEventListener('DOMContentLoaded', function() {
//     var deviceToken = localStorage.getItem('deviceTokenId') || 'default_token';
//     let eventSource = new EventSource(`../update.php?device_token=${deviceToken}`);

//     let lastId = null; 

// eventSource.onmessage = function(event) {
//     const data = JSON.parse(event.data);

//     // Check if device_id has changed
//     // Hanya perbarui tampilan jika ID baru berbeda dari ID terakhir
//     if (data.id !== lastId) {
//         Swal.fire({
//             icon: 'info',
//             title: 'Registration Card',
//             text: `Registration card folio ${data.folio}, nama ${data.fnama} siap di tandatangani!`,
//             showConfirmButton: false
//         });
//     }
// }
// });

//     // Update form fields with received data
//     document.getElementById('roomType').value = data.roomtype;
//     document.getElementById('pdfFile').value = data.at_regform;
//     document.getElementById('text1').value = data.room;
//     document.getElementById('text2').value = data.folio;
//     document.getElementById('text3').value = data.dateci;
//     document.getElementById('text4').value = data.dateco;
//     document.getElementById('text5').value = data.fnama;
//     document.getElementById('text6').value = data.jenis_kelamin;
//     document.getElementById('text7').value = data.birthday;
//     document.getElementById('text8').value = data.address;

//     // Update message based on the new room type
//     const roomType = data.roomtype;
//     if (roomType.toLowerCase() === 'non-smoking') {
//         showNonSmokingRoom();
//     } else if (roomType.toLowerCase() === 'smoking') {
//         showSmokingRoom();
//     } else {
//         showClear();
//     }

//     // Perbarui lastId dengan id baru
//     lastId = data.id;
// };

// eventSource.onerror = function(error) {
//     console.error('EventSource failed:', error);
//         // Handle the error as needed
//     };
// });


//  function showNonSmokingRoom() {
//     const messageDiv = document.getElementById('message');
//     const message = `
//         <img src="images/1.png" alt="no-smoking" class="doNot">
//         <img src="images/2.png" alt="no-pets" class="doNot">
//         <img src="images/3.png" alt="durian" class="doNot">
//         <p><strong>REGISTRASI KAMAR NON-SMOKING</strong><br><i>NON-SMOKING ROOM REGISTRATION</i></p>
//         <p><strong>Selamat datang di Dafam Hotel Semarang. Kami bangga melayani Anda..</strong></p>
//         <p>Kami informasikan bahwa Anda tinggal di kamar bebas rokok, sehingga Anda tidak diperkenankan untuk merokok selama masa tinggal Anda.<br>
//         Bilamana kami terpaksa tidak bisa menjual kamar ini akibat rokok ataupun asap rokok yang Anda timbulkan atau oleh tamu yang berkunjung ke kamar Anda,<br>kami akan membebankan biaya pembersihan dan penggantian sebesar <strong>Rp. 1.000.000,-</strong> ke rekening Anda.</p>
//         <ol>
//             <li>Dilarang Membawa Buah Durian, Charge <strong>Rp. 1.000.000,-</strong></li>
//             <li>Dilarang Membawa Buah Naga, Charge <strong>Rp. 1.000.000,-</strong></li>
//             <li>Dilarang Membawa PET (Hewan Peliharaan), Charge <strong>Rp. 1.000.000,-</strong></li>
//         </ol>
//         <p>Untuk itu, kami sangat menghargai kesediaan Anda menandatangani pernyataan untuk tidak merokok di bawah ini, dan kami senantiasa berharap Anda menikmati kunjungan di Dafam Hotel Semarang</p>
                    
//         <p><strong>Welcome to Dafam Hotel & Resort! We are very honored to have you as our guest.</strong></p>
//         <p>Please note that you have been assigned in a NON-SMOKING room, therefore by signing below you agree to observe the NON-SMOKING signs on the floor and refrain from smoking in the room during your entire stay.<br>
//         In the event the room is found not rentable as result of SMOKING either by your good self or your visiting guest, you are liable to pay the complete cleaning and fabric replacement charge of <strong>Rp. 1.000.000,- net</strong> per incident</p>
//         <ol>
//             <li>It is forbidden to carry durian fruit, Charge <strong>Rp. 1,000,000,-</strong></li>
//             <li>It is forbidden to bring dragon fruit, Charge <strong>Rp. 1,000,000,-</strong></li>
//             <li>Prohibited from Bringing PET, Charge <strong>Rp. 1,000,000,-</strong></li>
//         </ol>
//         <p>Meanwhile, we do appreciate your patience and understanding in observing the non-smoking signs.</p>
//         <p><i>Hotel tidak bertanggung jawab atas kehilangan uang, perhiasan, barang-barang berharga lainnya di kamar.
//             Kotak Deposit tersedia di Front Desk. Tanda tangan Anda memberikan otorisasi kepada kami untuk melakukan penagihan sesuai pembayaran di atas.
//             Kepada Dafam Hotel Semarang, saya menyatakan bahwa saya sendiri akan bersama-sama dengan perusahaan, asosiasi, perorangan atau semua yang bertanggung jawab atas pembayaran semua tagihan yang terjadi sehubungan dengan seluruh pelayanan yang Anda berikan sesuai formulir pendaftaran ini.</i></p>
//             <p><i>Money, Jewels and Other Valuables must be placed in a Hotel Safety Deposit Box, Otherwise the Management will NOT be responsible for any loss.
//             Signature authorizes after departure billing Indicated in the Method of Payment.
//             To DAFAM HOTEL SEMARANG I acknowledge that I am jointly and severally with the foregoing person, Company or association (and if more than one or all of them) for payment of the costs and charges payable or incurred in connection with all services provided by you under the registration.</i></p>
//     `;
//     messageDiv.innerHTML = message;
// }

// // Function to display smoking room message
// function showSmokingRoom() {
//     const messageDiv = document.getElementById('message');
//     const message = `
//         <img src="images/2.png" alt="no-pets" class="doNot">
//         <img src="images/3.png" alt="durian" class="doNot">
//         <p><strong>REGISTRASI KAMAR SMOKING</strong><br><i>SMOKING ROOM REGISTRATION</i></p>
//         <p><strong>Selamat datang di Hotel Dafam Semarang. Kami bangga melayani Anda..</strong></p>
//         <p>Kami informasikan bahwa Anda tinggal di kamar boleh merokok, sehingga Anda diperbolehkan untuk merokok selama masa tinggal Anda.<br> 
//         Bilamana kami terpaksa tidak bisa menjual kamar ini akibat bau menyengat dari buah yang anda bawa atau oleh tamu yang berkunjung ke kamar Anda, kami akan membebankan biaya pembersihan dan penggantian sebesar <strong>Rp. 1.000.000,-</strong> ke rekening Anda.</p> 
//         <ol>
//             <li>Dilarang Membawa Buah Durian, Charge <strong>Rp. 1.000.000,-</strong></li>
//             <li>Dilarang Membawa Buah Naga, Charge <strong>Rp. 1.000.000,-</strong></li>
//             <li>Dilarang Membawa PET (Hewan Peliharaan), Charge <strong>Rp. 1.000.000,-</strong></li>
//         </ol>
//         <p>Untuk itu, kami sangat menghargai kesediaan Anda menandatangani pernyataan untuk tidak merokok di bawah ini, dan kami senantiasa berharap Anda menikmati kunjungan di Dafam Hotel Semarang</p>

//         <p><strong>Welcome to Dafam Hotel Semarang. We are proud to serve you..</strong></p> 
//         <p>We inform you that you are staying in a smoking room, so you are welcome to smoke during your stay.<br> 
//         If we are forced to not be able to sell this room due to the strong smell of the fruit you brought or by guests visiting your room, we will charge a cleaning and replacement fee of <strong>Rp. 1.000.000,- net</strong> per incident</p> 
//         <ol>
//             <li>It is forbidden to carry durian fruit, Charge <strong>Rp. 1,000,000,-</strong></li>
//             <li>It is forbidden to bring dragon fruit, Charge <strong>Rp. 1,000,000,-</strong></li>
//             <li>Prohibited from Bringing PET, Charge <strong>Rp. 1,000,000,-</strong></li>
//         </ol>
//         <p>For that, we really appreciate your willingness to sign the statement below, and we always hope you enjoyed your visit at Hotel Dafam Semarang.</p>
//         <p><i>Hotel tidak bertanggung jawab atas kehilangan uang, perhiasan, barang-barang berharga lainnya di kamar.
//             Kotak Deposit tersedia di Front Desk. Tanda tangan Anda memberikan otorisasi kepada kami untuk melakukan penagihan sesuai pembayaran di atas.
//             Kepada Dafam Hotel Semarang, saya menyatakan bahwa saya sendiri akan bersama-sama dengan perusahaan, asosiasi, perorangan atau semua yang bertanggung jawab atas pembayaran semua tagihan yang terjadi sehubungan dengan seluruh pelayanan yang Anda berikan sesuai formulir pendaftaran ini.</i></p>
//         <p><i>Money, Jewels and Other Valuables must be placed in a Hotel Safety Deposit Box, Otherwise the Management will NOT be responsible for any loss.
//             Signature authorizes after departure billing Indicated in the Method of Payment.
//             To DAFAM HOTEL SEMARANG I acknowledge that I am jointly and severally with the foregoing person, Company or association (and if more than one or all of them) for payment of the costs and charges payable or incurred in connection with all services provided by you under the registration.</i></p>
//     `;
//     messageDiv.innerHTML = message;
// }

// document.getElementById('save-btn').addEventListener('click', function () {
//     var no_telp = document.getElementById('text9').value;
//     var pdfFile = document.getElementById('pdfFile').value;
//     var folio = document.getElementById('text2').value;
//     var email = document.getElementById('email').value;

//     // Memeriksa apakah nomor telepon atau alamat email kosong
//     if (no_telp.trim() === '' || email.trim() === '') {
//         // Menampilkan pesan kesalahan jika nomor telepon atau alamat email kosong
//         Swal.fire({
//             icon: 'info',
//             title: 'Oops...',
//             text: 'Nomor telepon dan alamat email harus diisi!',
//             showConfirmButton: false
//         });
//     } else if (signaturePad.isEmpty()) {
//         // Memeriksa apakah tanda tangan kosong
//         Swal.fire({
//             iconHtml: '<i class="fa-solid fa-signature fa-2xs" style="color: #ff2b85;"></i>',
//             title: 'Oops...',
//             text: 'Silakan tandatangani terlebih dahulu!',
//             showConfirmButton: false
//         });
//     } else {
//         // Mendapatkan data tanda tangan
//         var signatureData = signaturePad.toDataURL();
        
//         // Mengirim data ke server
//         sendData(no_telp, device_id, signatureData, pdfFile, folio, email);
//     }
//     unlinkDevice(tokenId);
// });

// function unlinkDevice(tokenId) {
//     $.ajax({
//         url: 'unlinkDevice.php',
//         type: 'POST',
//         data: { token_id: tokenId, regform_id: '0' }, // Menambahkan status 'unpaired'
//         success: function(response) {
//             console.log("Doc unlinked");
//         },
//         error: function() {
//             console.error("Failed to unlink doc");
//         }
//     });
// }


// function sendData(no_telp, device_id, signatureData, pdfFile, folio, email) {
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', 'https://card.dafam.cloud/sign_store.php', true);
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

//     // Format data yang akan dikirim
//     var params = `no_telp=${encodeURIComponent(no_telp)}&device_id=${encodeURIComponent(device_id)}&signatureData=${encodeURIComponent(signatureData)}&pdfFile=${encodeURIComponent(pdfFile)}&folio=${encodeURIComponent(folio)}&email=${encodeURIComponent(email)}`;

//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'OK...',
//                     text: 'Registration card berhasil ditandatangani',
//                     showConfirmButton: false,
//                     timer: 3000 // Display the alert for 3 seconds
//                 }).then(() => {
//                     // Reload the page after the alert is closed
//                     location.reload();
//                 });
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: 'Error uploading data.',
//                     showConfirmButton: true
//                 }).then(() => {
//                     // Reload the page even after an error, if desired
//                     location.reload();
//                 });
//             }
//         }
//     };

//     // Membuat string data yang akan dikirim
//     var formData =  '&no_telp=' + encodeURIComponent(no_telp) +
//                     '&device_id=' + encodeURIComponent(device_id) + 
//                     '&signature=' + encodeURIComponent(signatureData) +
//                     '&pdfFile=' + encodeURIComponent(pdfFile) + 
//                     '&folio=' + encodeURIComponent(folio) +
//                     '&email=' + encodeURIComponent(email);

//     // Mengirim data ke server
//     xhr.send(formData);
// }

// document.getElementById('pairing-btn').addEventListener('click', function() {
//     // Cek jika local storage sudah memiliki token_id
//     if (!localStorage.getItem('deviceTokenId')) {
//         // Jika tidak ada token_id, minta user untuk memasukkan token_id
//         Swal.fire({
//             title: 'Enter Token ID',
//             input: 'text',
//             inputAttributes: {
//                 autocapitalize: 'off',
//                 style: 'margin-bottom: 40px;' // Menambahkan margin bottom 40px
//             },
//             showConfirmButton: false,
//             showCancelButton: false,
//             showLoaderOnConfirm: true,
//             preConfirm: (token_id) => {
//                 // Lakukan AJAX untuk memeriksa token_id
//                 return fetch(`getToken.php`, {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/x-www-form-urlencoded',
//                     },
//                     body: `token_id=${token_id}`
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.error) {
//                         throw new Error(data.error);
//                     }
//                     return data;
//                 })
//                 .catch(error => {
//                     Swal.showValidationMessage(`Request failed: ${error}`);
//                 });
//             },
//             allowOutsideClick: () => !Swal.isLoading()
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 // Menyimpan token_id ke local storage
//                 localStorage.setItem('deviceTokenId', result.value.token_id);
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Paired',
//                     text: 'Token ID verified ' + result.value.token_id,
//                     showConfirmButton: false
//                 }).then(() => {
//                     // Kirim permintaan untuk update status
//                     $.ajax({
//                         url: 'PairUnpairDevice.php',
//                         type: 'POST',
//                         data: { token_id: result.value.token_id},
//                         success: function(updateResponse) {
//                             console.log("Status updated successfully");
//                             // Reload halaman setelah status berhasil diupdate
//                             location.reload();
//                         },
//                         error: function() {
//                             console.error("Failed to update status");
//                         }
//                     });
//                 });
//             }
//         });
//     } else {
//         // Jika token_id sudah ada, beri notifikasi bahwa device sudah dipair
//         Swal.fire({
//             icon: 'warning',
//             title: 'Oops...',
//             text: 'Device already paired with token ID ' + localStorage.getItem('deviceTokenId'),
//             showConfirmButton: false
//         });
//     }
// });

// document.getElementById('unpair-btn').addEventListener('click', function() {
// var tokenId = localStorage.getItem('deviceTokenId');
// if (!tokenId) {
//  // Menampilkan notifikasi jika tidak ada token ID
//  Swal.fire({
//      icon: 'error',
//      title: 'Error',
//      text: 'No token ID saved',
//      showConfirmButton: false
//  });
// } else {
//  Swal.fire({
//      title: 'Password',
//      input: 'password',
//      inputAttributes: {
//          autocapitalize: 'off',
//          autocorrect: 'off',
//          style: 'margin-bottom: 40px;' // Menambahkan margin bottom 40px
//      },
//      showCancelButton: false,
//      showConfirmButton: false,
//      showLoaderOnConfirm: true,
//      preConfirm: (password) => {
//          if (password === "Dafam@188") {
//              // Mengirim permintaan ke server untuk update status
//              $.ajax({
//                  url: 'PairUnpairDevice.php',
//                  type: 'POST',
//                  data: { token_id: tokenId}, // Menambahkan status 'unpaired'
//                  success: function(response) {
//                      console.log("Status updated successfully");
//                      // Menghapus token_id dari local storage setelah berhasil update status
//                      localStorage.removeItem('deviceTokenId');
//                      // Menampilkan notifikasi bahwa device telah di-unpair
//                      Swal.fire({
//                          icon: 'info',
//                          title: 'Unpaired',
//                          text: 'Unpairing device success, token removed',
//                          showConfirmButton: false
//                      }).then(() => {
//                         // Reload halaman setelah notifikasi ditutup
//                         location.reload();
//                     });
//                  },
//                  error: function() {
//                      console.error("Failed to update status");
//                  }
//              });
//          } else {
//              Swal.fire({
//                  icon: 'error',
//                  title: 'Authentication failed',
//                  text: 'Incorrect password',
//                  showConfirmButton: false
//              });
//          }
//      },
//      allowOutsideClick: () => !Swal.isLoading()
//  });
// }
// });

document.addEventListener('DOMContentLoaded', function() {
    var deviceToken = localStorage.getItem('deviceTokenId') || 'default_token';
    let eventSource = new EventSource(`../update.php?device_token=${deviceToken}`);

    let lastId = null; // Variabel untuk menyimpan id terakhir yang diterima

    eventSource.onmessage = function(event) {
        const data = JSON.parse(event.data);

        // Hanya perbarui tampilan jika ID baru berbeda dari ID terakhir
        if (data.id !== lastId) {
            // Tampilkan notifikasi
            Swal.fire({
                icon: 'info',
                title: 'Guestfolio',
                text: `Guestfolio ${data.folio}, nama ${data.fname} siap untuk di tandatangani!`,
                showConfirmButton: false
            });

            // Update form fields with received data
            // document.getElementById('id').value = data.id;
            document.getElementById('pdfFile').value = data.at_guestfolio;
            document.getElementById('folio').value = data.folio;

            // Langsung muat dan render PDF
            const pdfUrl = data.at_guestfolio;
            const loadingTask = pdfjsLib.getDocument(pdfUrl);
            loadingTask.promise.then(function(pdf) {
                console.log('PDF loaded');
                // Ambil halaman pertama PDF
                pdf.getPage(1).then(function(page) {
                    console.log('Page loaded');
                    const scale = 1;
                    const viewport = page.getViewport({scale: scale});
                    // Buat canvas untuk menampilkan halaman PDF
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    // Menggambar halaman PDF ke dalam canvas
                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    const renderTask = page.render(renderContext);
                    renderTask.promise.then(function() {
                        console.log('Page rendered');
                        // Hapus konten lama dari pdf-viewer
                        const pdfViewer = document.getElementById('pdf-container');
                        pdfViewer.innerHTML = '';
                        // Menambahkan canvas ke dalam div
                        pdfViewer.appendChild(canvas);
                    });
                });
            }).catch(function(reason) {
                // Jika gagal memuat PDF
                console.error('Error: ' + reason);
            });

            // Perbarui lastId dengan id baru
            lastId = data.id;
        }
    };

    eventSource.onerror = function(error) {
        console.error('EventSource failed:', error);
    };
});

document.getElementById('save-btn').addEventListener('click', function () {
    var id = document.getElementById('id').value; // Ganti 'device_token' dengan 'id'
    var pdfFile = document.getElementById('pdfFile').value;
    var folio = document.getElementById('folio').value;

    if (signaturePad.isEmpty()) {
        // Memeriksa apakah tanda tangan kosong
        Swal.fire({
            iconHtml: '<i class="fa-solid fa-signature fa-2xs" style="color: #ff2b85;"></i>',
            title: 'Oops...',
            text: 'Silakan tandatangani terlebih dahulu!',
            showConfirmButton: false
        });
    } else {
        // Mendapatkan data tanda tangan
        var signatureData = signaturePad.toDataURL();
        
        // Mengirim data ke server
        sendData(id, signatureData, pdfFile, folio); // Ganti 'device_token' dengan 'id'

        // Memanggil fungsi unpairDevice
        var tokenId = localStorage.getItem('deviceTokenId');
        if (tokenId) {
            unlinkDevice(tokenId);
        } else {
            console.error("No deviceTokenId found in localStorage.");
        }
    }
});

function unlinkDevice(tokenId) {
    $.ajax({
        url: 'unlinkDevice.php',
        type: 'POST',
        data: { token_id: tokenId, regform_id: '0' }, // Menambahkan status 'unpaired'
        success: function(response) {
            console.log("Doc unlinked");
        },
        error: function() {
            console.error("Failed to unlink doc");
        }
    });
}

function sendData(id, signatureData, pdfFile, folio) { // Ganti 'device_token' dengan 'id'
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'https://fo.dafam.cloud/g_sign_store.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    // Format the data to be sent
    var params = `id=${encodeURIComponent(id)}&signatureData=${encodeURIComponent(signatureData)}&pdfFile=${encodeURIComponent(pdfFile)}&folio=${encodeURIComponent(folio)}`; // Ganti 'device_token' dengan 'id'

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'OK...',
                    text: 'Guestfolio berhasil ditandatangani',
                    showConfirmButton: false,
                    timer: 3000 // Display the alert for 2 seconds
                }).then(() => {
                    // Reload the page after the alert is closed
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error uploading data.',
                    showConfirmButton: false
                }).then(() => {
                    // Reload the page even after an error, if desired
                    location.reload();
                });
            }
        }
    };
    
    // Membuat string data yang akan dikirim
    var formData =  '&id=' + encodeURIComponent(id) +  // Ganti 'device_token' dengan 'id'
                    '&signature=' + encodeURIComponent(signatureData) +
                    '&pdfFile=' + encodeURIComponent(pdfFile) + 
                    '&folio=' + encodeURIComponent(folio);

    // Mengirim data ke server
    xhr.send(formData);
}

document.getElementById('pairing-btn').addEventListener('click', function() {
    // Cek jika local storage sudah memiliki token_id
    if (!localStorage.getItem('deviceTokenId')) {
        // Jika tidak ada token_id, minta user untuk memasukkan token_id
        Swal.fire({
            title: 'Enter Token ID',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                style: 'margin-bottom: 40px;' // Menambahkan margin bottom 40px
            },
            showConfirmButton: false,
            showCancelButton: false,
            showLoaderOnConfirm: true,
            preConfirm: (token_id) => {
                // Lakukan AJAX untuk memeriksa token_id
                return fetch(`getToken.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `token_id=${token_id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }
                    return data;
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                // Menyimpan token_id ke local storage
                localStorage.setItem('deviceTokenId', result.value.token_id);
                Swal.fire({
                    icon: 'success',
                    title: 'Paired',
                    text: 'Token ID verified ' + result.value.token_id,
                    showConfirmButton: false
                }).then(() => {
                    // Kirim permintaan untuk update status
                    $.ajax({
                        url: 'PairUnpairDevice.php',
                        type: 'POST',
                        data: { token_id: result.value.token_id},
                        success: function(updateResponse) {
                            console.log("Status updated successfully");
                            // Reload halaman setelah status berhasil diupdate
                            location.reload();
                        },
                        error: function() {
                            console.error("Failed to update status");
                        }
                    });
                });
            }
        });
    } else {
        // Jika token_id sudah ada, beri notifikasi bahwa device sudah dipair
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Device already paired with token ID ' + localStorage.getItem('deviceTokenId'),
            showConfirmButton: false
        });
    }
});

document.getElementById('unpair-btn').addEventListener('click', function() {
var tokenId = localStorage.getItem('deviceTokenId');
if (!tokenId) {
 // Menampilkan notifikasi jika tidak ada token ID
 Swal.fire({
     icon: 'error',
     title: 'Error',
     text: 'No token ID saved',
     showConfirmButton: false
 });
} else {
 Swal.fire({
     title: 'Password',
     input: 'password',
     inputAttributes: {
         autocapitalize: 'off',
         autocorrect: 'off',
         style: 'margin-bottom: 40px;' // Menambahkan margin bottom 40px
     },
     showCancelButton: false,
     showConfirmButton: false,
     showLoaderOnConfirm: true,
     preConfirm: (password) => {
         if (password === "Dafam@188") {
             // Mengirim permintaan ke server untuk update status
             $.ajax({
                 url: 'PairUnpairDevice.php',
                 type: 'POST',
                 data: { token_id: tokenId}, // Menambahkan status 'unpaired'
                 success: function(response) {
                     console.log("Status updated successfully");
                     // Menghapus token_id dari local storage setelah berhasil update status
                     localStorage.removeItem('deviceTokenId');
                     // Menampilkan notifikasi bahwa device telah di-unpair
                     Swal.fire({
                         icon: 'info',
                         title: 'Unpaired',
                         text: 'Unpairing device success, token removed',
                         showConfirmButton: false
                     }).then(() => {
                        // Reload halaman setelah notifikasi ditutup
                        location.reload();
                    });
                 },
                 error: function() {
                     console.error("Failed to update status");
                 }
             });
         } else {
             Swal.fire({
                 icon: 'error',
                 title: 'Authentication failed',
                 text: 'Incorrect password',
                 showConfirmButton: false
             });
         }
     },
     allowOutsideClick: () => !Swal.isLoading()
 });
}
});