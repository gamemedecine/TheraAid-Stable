import json, requests

file = open("./therapists.json", "r")
jsons = json.loads(file.read())

for i, j in enumerate(jsons):
    i = i + 1

    username = j["username"]
    firstName = j["firstName"]
    middleName = j["middleName"]
    lastName = j["lastName"]
    password = j["password"]
    email = j["email"]
    mobileNumber = j["mobileNumber"]
    birthday = j["birthday"]
    caseHandled = j["caseHandled"]
    address = j["address"]

    url = "http://localhost/projects/TheraAid-Stable/TherapistRegistration.php"
    formData = {
        "username": username,
        "firstName": firstName,
        "middleName": middleName,
        "lastName": lastName,
        "password": password,
        "email": email,
        "mobileNumber": mobileNumber,
        "birthDate": birthday,
        "caseHandled": caseHandled,
        "location": address
    }
    files = {
        "profilePicture": open(f"./UserFiles/TherapistsProfilePictures/{i}.jpg", "rb"),
        "licenseImage": open("./UserFiles/therapist-license.png", "rb")
    }

    response = requests.post(url=url, data=formData, files=files)

    if not response.status_code == 200:
        with open("./therapist_log.html", "w") as file:
            file.write(response.text)
        break
    else: print(response.status_code)