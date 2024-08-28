const mailer = require("nodemailer");
const http = require("http");
const { parse } = require("cookie");
const { URL } = require("url");
const { exit } = require("process");

//Nodemailer transporter
const transporter = mailer.createTransport({
  service: "gmail",
  auth: {
    user: "dhanushns2004@gmail.com",
    pass: "epez sxtu dvmj sero",
  },
});

function sendOTP(to, subject, text) {
  const mailOptions = {
    from: "dhanushns2004@gmail.com",
    to: to,
    subject: subject,
    text: text,
  };
  transporter.sendMail(mailOptions, (err, info) => {
    if (err) return console.log(err);
  });
}

const server = http
  .createServer((req, res) => {
    if (req.url === "/sendOTP" && req.method === "GET") {
      const cookies = parse(req.headers.cookie || " ");
      const email = cookies.email;
      if (email) {
        const OTP = Math.floor(100000 + Math.random() * 900000);
        sendOTP(email, "NSJ : Password Reset OTP", "Your OTP : " + OTP);
        res.writeHead(302, { Location: "http://localhost/NS_Jewells" });
        res.end();
      } else {
        res.writeHead(404, { "Content-Type": "text/plain" });
        res.end("Not found");
      }
    } else {
      res.writeHead(404, { "Content-Type": "text/plain" });
      res.end("Not found.");
    }
  })
  .listen(8080);
