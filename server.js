import express from 'express';
import { default as fetch } from 'node-fetch';
import cors from 'cors'; // Import the CORS middleware
const app = express();
const port = 3000;
let otpTokens;
app.use(express.json());
app.use(cors({ origin: 'http://localhost' })); // Set the allowed origin

app.post('/send-otp', async (req, res) => {
    const { phone } = req.body;
    try {
        const response = await fetch('https://otp.thaibulksms.com/v2/otp/request', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `key=1792929791919926&secret=a8acf384990ce72cb2b01c1dc3b2b950&msisdn=${phone}`,
        });
        const data = await response.json();
        res.json(data);
        otpTokens = data.token;
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'An error occurred while sending OTP' });
    }
});

// Endpoint to verify OTP
app.post('/verify-otp', async (req, res) => {
    const { token,pin } = req.body;
    try {
        const response = await fetch('https://otp.thaibulksms.com/v2/otp/verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `token=${otpTokens}&pin=${pin}&key=1793156650635627&secret=4491e4460d5eb83e81ff453c6ed17a62`,
        });
        const data = await response.json();
        res.json(data);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'An error occurred while verifying OTP' });
    }
});

app.listen(port, () => {
    console.log(`Server is listening at http://localhost:${port}`);
});
