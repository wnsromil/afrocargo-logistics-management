<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: #000;
        }
        .label-container {
            width: 460px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ffffff;
        }
        .address-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }
        .header-divider {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 10px 0;
        }
        .barcode-section {
            border-bottom: 1px solid #000;
            text-align: center;
            padding: 20px 0;
        }
        .tracking-number {
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <div class="label-container">
        <table class="address-table">
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>
                                <img style="max-width: 60px; margin-right: 5px;" src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                            </td>
                            <td style="vertical-align: top;">
                                Afro Cargo Express Llc NY<br> 
                                366 Concord Ave<br>
                                NY The Bronx<br>
                                646-468-4135<br> 
                                718-954-9093
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="text-align: right; vertical-align: top;">
                    Afro Cargo Express Llc Abidjan<br> 
                    Avenue 21<br>
                    Rue 15 Treichville<br>
                    Abidjan Autonomous District Abidjan <br> 
                    07 09 04 1250<br> 
                    07 89 49 2486
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height: 5px;"></td>
            </tr>
            <tr>
                <td colspan="2" class="tracking-number" id="trackingNumber">TIV-000982</td>
            </tr>
            <tr>
                <td colspan="2" style="height: 5px;"></td>
            </tr>
        </table>

        <table class="address-table header-divider">
            <tr>
                <td style="font-weight: 700; font-size: 14px;" id="labelDate">04/11/2025</td>
                <td style="font-weight: 700; font-size: 14px; text-align: right;">Afro Cargo Express Llc NY</td>
            </tr>
        </table>

        <table class="address-table" style="border-bottom: 1px solid #000;">
            <tr>
                <td>
                    <b style="font-size: 13px;">Ship To:</b><br>
                    <span id="shipToName">Fatoumata</span><br>
                    <span id="shipToAddress">1042 Oaks Dr</span><br>
                    <span id="shipToCityState">Ohio Columbus 42228</span><br>
                </td>
                <td style="text-align: right; font-size: 15px; font-weight: 700;">
                    Tracking Items: <span id="trackingItemsCount">2</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height: 5px;"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <span id="recipientName">Zeinabou</span><br>
                    <span id="recipientCity">Abidjan</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height: 5px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="font-weight: 500; font-size: 14px;">
                    Item: <span id="itemDescription">Barrel large</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height: 5px;"></td>
            </tr>
        </table>

        <div class="barcode-section">
            <img width="300px" alt="Barcode" src="https://d9wi98su9qvhp.cloudfront.net/production/kroC02.png">
            <div style="font-weight: bold; font-size: 16px; margin-top: 5px;">
                <span id="destinationCode">Abidjam</span>
            </div>
            <div style="font-weight: bold; font-size: 16px;">
                <span id="originCode">AbidjaM</span>
            </div>
        </div>
    </div>

    <script>
        // Function to populate label data
        function populateLabelData(labelData) {
            document.getElementById('trackingNumber').textContent = labelData.trackingNumber || 'TIV-000000';
            document.getElementById('labelDate').textContent = labelData.date || formatDate(new Date());
            document.getElementById('shipToName').textContent = labelData.shipTo.name || 'N/A';
            document.getElementById('shipToAddress').textContent = labelData.shipTo.address || 'N/A';
            document.getElementById('shipToCityState').textContent = 
                `${labelData.shipTo.city || ''} ${labelData.shipTo.state || ''} ${labelData.shipTo.zip || ''}`.trim();
            document.getElementById('trackingItemsCount').textContent = labelData.itemCount || '1';
            document.getElementById('recipientName').textContent = labelData.recipient.name || 'N/A';
            document.getElementById('recipientCity').textContent = labelData.recipient.city || 'N/A';
            document.getElementById('itemDescription').textContent = labelData.itemDescription || 'N/A';
            document.getElementById('destinationCode').textContent = labelData.destinationCode || 'N/A';
            document.getElementById('originCode').textContent = labelData.originCode || 'N/A';
            
            // Set barcode image if provided
            if (labelData.barcodeImage) {
                document.querySelector('.barcode-section img').src = labelData.barcodeImage;
            }
        }

        // Helper function to format date
        function formatDate(date) {
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const year = date.getFullYear();
            return `${month}/${day}/${year}`;
        }

        // Example usage:
        const labelData = {
            trackingNumber: 'TIV-000982',
            date: '04/11/2025',
            shipTo: {
                name: 'Fatoumata',
                address: '1042 Oaks Dr',
                city: 'Ohio Columbus',
                state: '',
                zip: '42228'
            },
            itemCount: '2',
            recipient: {
                name: 'Zeinabou',
                city: 'Abidjan'
            },
            itemDescription: 'Barrel large',
            destinationCode: 'Abidjam',
            originCode: 'AbidjaM',
            barcodeImage: 'https://d9wi98su9qvhp.cloudfront.net/production/kroC02.png'
        };

        // Populate the label with data
        populateLabelData(labelData);

        // For printing (can be triggered by a button)
        function printLabel() {
            window.print();
        }
    </script>
</body>
</html>