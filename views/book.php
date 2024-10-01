<?php
    include("../dbConection.php");
    $move = $database->prepare("SELECT * FROM seats Where IdMovie=:id");
    $move->bindParam('id',$_GET['moveId']);
    $move->execute();
    $data = $move->fetchAll();
    $booked = array();
    foreach($data AS $row){
        array_push($booked,$row['Number']);
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ticket Booking</title>
    <!--Google Fonts and Icons-->
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <link href="../assets/css/book.css" rel="stylesheet" />
</head>

<body>
    <h1><?php  ?></h1>
    <form action="" method="post">
        <div class="center">
            <div class="tickets">
                <div class="ticket-selector">
                    <div class="head">
                        <div class="title">Seats</div>
                    </div>
                    <div class="seats">
                        <div class="status">
                            <div class="item">Available</div>
                            <div class="item">Booked</div>
                            <div class="item">Selected</div>
                        </div>
                        <div class="all-seats">
                            <!-- <input type="checkbox" name="tickets" id="s1" />
                            <label for="s1" class="seat booked"></label> -->
                        </div>
                    </div>
                    <div class="timings">
                        <div class="dates">
                            <input type="radio" value="Sun-11" name="date" id="d1" checked />
                            <label for="d1" class="dates-item">
                                <div class="day">Sun</div>
                                <div class="date">11</div>
                            </label>
                            <input type="radio" value="Mon-12" id="d2" name="date" />
                            <label class="dates-item" for="d2">
                                <div class="day">Mon</div>
                                <div class="date">12</div>
                            </label>
                            <input type="radio" value="Tue-13" id="d3" name="date" />
                            <label class="dates-item" for="d3">
                                <div class="day">Tue</div>
                                <div class="date">13</div>
                            </label>
                            <input type="radio" value="Wed-14" id="d4" name="date" />
                            <label class="dates-item" for="d4">
                                <div class="day">Wed</div>
                                <div class="date">14</div>
                            </label>
                            <input type="radio" value="Thu-16" id="d5" name="date" />
                            <label class="dates-item" for="d5">
                                <div class="day">Thu</div>
                                <div class="date">15</div>
                            </label>
                            <input type="radio" value="Fri-16" id="d6" name="date" />
                            <label class="dates-item" for="d6">
                                <div class="day">Fri</div>
                                <div class="date">16</div>
                            </label>
                            <input type="radio" value="Sat-17" id="d7" name="date" />
                            <label class="dates-item" for="d7">
                                <div class="day">Sat</div>
                                <div class="date">17</div>
                            </label>
                        </div>
                        <div class="times">
                            <input type="radio" name="time" value="11:00" id="t1" checked />
                            <label for="t1" class="time">11:00</label>
                            <input type="radio" id="t2" value="14:30" name="time" />
                            <label for="t2" class="time"> 14:30 </label>
                            <input type="radio" id="t3" value="18:00" name="time" />
                            <label for="t3" class="time"> 18:00 </label>
                            <input type="radio" id="t4" value="11:00" name="time" />
                            <label for="t4" class="time"> 21:30 </label>
                        </div>
                    </div>
                </div>
                <div class="price">
                    <div class="total">
                        <span> <span class="count">0</span> Tickets </span>
                        <div id="amount" class="amount">0</div>
                    </div>
                    <button type="button" id="book" name="book">Book</button>
                </div>
            </div>
        </div>
    </form>
    <script>
    let seats = document.querySelector(".all-seats");
    let bookedSeats = <?php echo json_encode($booked)?>;
    let seatsContainer = document.querySelector(".all-seats");
    let Seats = [];

    for (let i = 1; i <= 60; i++) {
        let seatId = 's' + i;
        let bookingStatus = bookedSeats.includes(seatId) ? 'booked' : '';

        Seats.push(seatId);
        seatsContainer.insertAdjacentHTML(
            "beforeend",
            `<input type="checkbox" value="${seatId}" name="tickets" id="${seatId}" />
         <label for="${seatId}" class="seat ${bookingStatus}"></label>`
        );
    }
    let tickets = seats.querySelectorAll("input");
    tickets.forEach((ticket) => {
        ticket.addEventListener("change", () => {
            let amount = document.querySelector(".amount").innerHTML;
            let count = document.querySelector(".count").innerHTML;
            amount = Number(amount);
            count = Number(count);

            if (ticket.checked) {
                count += 1;
                amount += 200;
            } else {
                count -= 1;
                amount -= 200;
            }
            document.querySelector(".amount").innerHTML = amount;
            document.querySelector(".count").innerHTML = count;
        });
    });
    let times = ['t1', 't2', 't3', 't4'];
    let dates = ['d1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7'];
    const formData = new FormData();
    // Target the submit button
    let submitBtn = document.getElementById('book');

    // Listen for click event on the button 
    submitBtn.addEventListener('click', function() {
        // Collect input field values
        let id = <?php echo $_GET['moveId'];?>;
        let time;
        for (let i = 0; i < times.length; i++) {
            const element = document.getElementById(times[i]);

            if (element.checked == true) {
                time = element.value;
            }

        }

        let date;
        for (let i = 0; i < dates.length; i++) {
            const element = document.getElementById(dates[i]);

            if (element.checked == true) {
                date = element.value;
            }

        }
        let seat;
        for (let i = 0; i < Seats.length; i++) {
            const element = document.getElementById(Seats[i]);

            if (element.checked == true) {
                seat = element.value;
            }

        }
        let price = document.getElementById('amount').innerText;
        // Create a FormData object to store the data
        const formData = new FormData();
        formData.append('time', time);
        formData.append('date', date);
        formData.append('seat', seat);
        formData.append('price', price);
        formData.append('bookNow', id);

        // Create an Ajax request
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../model/catchData.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Data sent successfully
                console.log(xhr.responseText);
                window.location.replace(
                    `../model/ticket.php?time=${time}&date=${date}&seat=${seat}&price=${price}&movieId=${id}`
                    );
            } else {
                // Error occurred while sending data
                console.error(xhr.statusText);
            }
        };
        xhr.onerror = function() {
            // Error occurred while sending data
            console.error(xhr.statusText);
        };
        xhr.send(formData);

    });
    </script>
</body>

</html>