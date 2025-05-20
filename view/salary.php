<?php
    session_start();
    if(isset($_COOKIE['status'])){

    }else{
        header(header: 'location: 1_login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Range Estimator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .tab {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .tab button {
            padding: 10px 20px;
            margin: 0 5px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .tab button:hover {
            background-color: #0056b3;
        }
        .tab button.active {
            background-color: #003087;
        }
        .section {
            display: none;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .section.active {
            display: block;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .comparison-table th, .comparison-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .comparison-table th {
            background-color: #007bff;
            color: white;
        }
        .benefits-list {
            list-style: none;
            padding: 0;
        }
        .benefits-list li {
            padding: 10px;
            background-color: #f9f9f9;
            margin-bottom: 5px;
            border-radius: 4px;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e7f3fe;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Salary Range Estimator</h1>
        <div class="tab">
            <button class="tablink active" onclick="openSection('estimator')">Compensation Estimator</button>
            <button class="tablink" onclick="openSection('comparison')">Role Comparison Tool</button>
            <button class="tablink" onclick="openSection('benefits')">Benefits Breakdown</button>
        </div>

        <!-- Compensation Estimator -->
        <div id="estimator" class="section active">
            <h2>Compensation Estimator</h2>
            <div class="form-group">
                <label for="position">Position</label>
                <select id="position">
                    <option value="software-engineer">Software Engineer</option>
                    <option value="data-scientist">Data Scientist</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <select id="location">
                    <option value="new-york">New York, NY</option>
                    <option value="san-francisco">San Francisco, CA</option>
                    <option value="remote">Remote</option>
                </select>
            </div>
            <button onclick="estimateSalary()">Estimate Salary</button>
            <div id="estimator-result" class="result"></div>
        </div>

        <!-- Role Comparison Tool -->
        <div id="comparison" class="section">
            <h2>Role Comparison Tool</h2>
            <div class="form-group">
                <label for="offer1-position">Offer 1: Position</label>
                <select id="offer1-position">
                    <option value="software-engineer">Software Engineer</option>
                    <option value="data-scientist">Data Scientist</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label for="offer1-salary">Offer 1: Base Salary ($)</label>
                <input type="number" id="offer1-salary" placeholder="Enter base salary">
            </div>
            <div class="form-group">
                <label for="offer1-bonus">Offer 1: Bonus ($)</label>
                <input type="number" id="offer1-bonus" placeholder="Enter bonus">
            </div>
            <div class="form-group">
                <label for="offer2-position">Offer 2: Position</label>
                <select id="offer2-position">
                    <option value="software-engineer">Software Engineer</option>
                    <option value="data-scientist">Data Scientist</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label for="offer2-salary">Offer 2: Base Salary ($)</label>
                <input type="number" id="offer2-salary" placeholder="Enter base salary">
            </div>
            <div class="form-group">
                <label for="offer2-bonus">Offer 2: Bonus ($)</label>
                <input type="number" id="offer2-bonus" placeholder="Enter bonus">
            </div>
            <button onclick="compareOffers()">Compare Offers</button>
            <table id="comparison-table" class="comparison-table" style="display: none;">
                <thead>
                    <tr>
                        <th>Offer</th>
                        <th>Position</th>
                        <th>Base Salary</th>
                        <th>Bonus</th>
                        <th>Total Compensation</th>
                    </tr>
                </thead>
                <tbody id="comparison-result"></tbody>
            </table>
        </div>

        <!-- Benefits Breakdown -->
        <div id="benefits" class="section">
            <h2>Benefits Breakdown</h2>
            <div class="form-group">
                <label for="benefits-position">Position</label>
                <select id="benefits-position">
                    <option value="software-engineer">Software Engineer</option>
                    <option value="data-scientist">Data Scientist</option>
                    <option value="product-manager">Product Manager</option>
                </select>
            </div>
            <button onclick="showBenefits()">Show Benefits</button>
            <ul id="benefits-list" class="benefits-list"></ul>
        </div>
    </div>

    <script>
        // Mock salary data
        const salaryData = {
            'software-engineer': {
                'new-york': { base: 120000, bonus: 15000 },
                'san-francisco': { base: 140000, bonus: 20000 },
                'remote': { base: 110000, bonus: 10000 }
            },
            'data-scientist': {
                'new-york': { base: 130000, bonus: 18000 },
                'san-francisco': { base: 150000, bonus: 22000 },
                'remote': { base: 120000, bonus: 12000 }
            },
            'product-manager': {
                'new-york': { base: 140000, bonus: 20000 },
                'san-francisco': { base: 160000, bonus: 25000 },
                'remote': { base: 130000, bonus: 15000 }
            }
        };

        // Mock benefits data
        const benefitsData = {
            'software-engineer': [
                'Health Insurance: Comprehensive coverage',
                '401(k) Matching: Up to 6%',
                'Stock Options: 500 units',
                'Paid Time Off: 20 days'
            ],
            'data-scientist': [
                'Health Insurance: Premium plan',
                '401(k) Matching: Up to 5%',
                'Stock Options: 400 units',
                'Paid Time Off: 18 days'
            ],
            'product-manager': [
                'Health Insurance: Full coverage',
                '401(k) Matching: Up to 7%',
                'Stock Options: 600 units',
                'Paid Time Off: 22 days'
            ]
        };

        function openSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.querySelectorAll('.tablink').forEach(button => {
                button.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
            document.querySelector(`button[onclick="openSection('${sectionId}')"]`).classList.add('active');
        }

        function estimateSalary() {
            const position = document.getElementById('position').value;
            const location = document.getElementById('location').value;
            const data = salaryData[position][location];
            const total = data.base + data.bonus;
            document.getElementById('estimator-result').innerHTML = `
                <h3>Estimated Compensation</h3>
                <p>Position: ${position.replace('-', ' ')}</p>
                <p>Location: ${location.replace('-', ' ')}</p>
                <p>Base Salary: $${data.base.toLocaleString()}</p>
                <p>Bonus: $${data.bonus.toLocaleString()}</p>
                <p>Total Compensation: $${total.toLocaleString()}</p>
            `;
        }

        function compareOffers() {
            const offer1 = {
                position: document.getElementById('offer1-position').value,
                salary: parseInt(document.getElementById('offer1-salary').value) || 0,
                bonus: parseInt(document.getElementById('offer1-bonus').value) || 0
            };
            const offer2 = {
                position: document.getElementById('offer2-position').value,
                salary: parseInt(document.getElementById('offer2-salary').value) || 0,
                bonus: parseInt(document.getElementById('offer2-bonus').value) || 0
            };
            const total1 = offer1.salary + offer1.bonus;
            const total2 = offer2.salary + offer2.bonus;

            document.getElementById('comparison-result').innerHTML = `
                <tr>
                    <td>Offer 1</td>
                    <td>${offer1.position.replace('-', ' ')}</td>
                    <td>$${offer1.salary.toLocaleString()}</td>
                    <td>$${offer1.bonus.toLocaleString()}</td>
                    <td>$${total1.toLocaleString()}</td>
                </tr>
                <tr>
                    <td>Offer 2</td>
                    <td>${offer2.position.replace('-', ' ')}</td>
                    <td>$${offer2.salary.toLocaleString()}</td>
                    <td>$${offer2.bonus.toLocaleString()}</td>
                    <td>$${total2.toLocaleString()}</td>
                </tr>
            `;
            document.getElementById('comparison-table').style.display = 'table';
        }

        function showBenefits() {
            const position = document.getElementById('benefits-position').value;
            const benefits = benefitsData[position];
            const benefitsList = document.getElementById('benefits-list');
            benefitsList.innerHTML = '';
            benefits.forEach(benefit => {
                const li = document.createElement('li');
                li.textContent = benefit;
                benefitsList.appendChild(li);
            });
        }
    </script>
</body>
</html>