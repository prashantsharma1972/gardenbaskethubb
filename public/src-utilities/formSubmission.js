import JustValidate from 'just-validate';

export const initZohoForm = (formID, leadSource, redirectionLocation) => {
    const formElement = document.querySelector(formID);

    const needFormValidation = new JustValidate(formID);

    // --- function to add fields only if they exist
    const addFieldIfExists = (selector, rules) => {
        if (formElement.querySelector(selector)) {
            needFormValidation.addField(selector, rules);
        }
    };

    addFieldIfExists('#form-fullname', [
        {
            rule: 'required',
        },
        {
            rule: 'customRegexp',
            value: /^[a-zA-Z]+ [a-zA-Z]+$/,
        },
    ])
    addFieldIfExists('#form-firstname', [
        {
            rule: "required",
        },
        { rule: "minLength", value: 2 },
        {
            rule: "customRegexp",
            value: /^[A-Za-z]+$/,
        },
    ])
    addFieldIfExists('#form-lastname', [
        {
            rule: "required",
        },
        { rule: "minLength", value: 2 },
        {
            rule: "customRegexp",
            value: /^[A-Za-z]+$/,
        },
    ])
    addFieldIfExists('#form-company', [
        {
            rule: 'required',
        },
        {
            rule: 'minLength',
            value: 2,
        },
    ])
    addFieldIfExists('#form-jobtitle', [
        {
            rule: 'required',
        },
        {
            rule: 'minLength',
            value: 2,
        },
    ])
    addFieldIfExists('#form-email', [
        {
            rule: 'required',
        },
        {
            rule: 'email',
        },
        {
            validator: (value) => {
                let emailRegex =
                    /^[a-zA-Z0-9](?:[a-zA-Z0-9._-]*[a-zA-Z0-9])?@[a-zA-Z0-9-]+(\.[a-zA-Z]{2,7})+$/;
                return emailRegex.test(value);
            },
            errorMessage: 'Please Enter Valid Email Address',
        },
    ])
    addFieldIfExists('#form-git-phonenumber', [
        {
            rule: 'required',
        },
        {
            rule: 'minLength',
            value: 4,
        },
        {
            rule: 'customRegexp',
            value: /^[0-9]+$/,
        },
        {
            rule: 'maxLength',
            value: 15,
        },
        {
            rule: 'number',
        },
    ])
    addFieldIfExists('#form-message', [
        {
            rule: 'required',
        },
    ])
    addFieldIfExists('[name="preffered-subject"]', [
        {
            rule: "required",
            errorMessage: "Please select a preferred Subject",
        },
    ]);

    let GoogleSendURL =
        'https://script.google.com/macros/s/AKfycbyML8OHUDSwwvY_QcBlZ2uHYN_rQIx_VlWZPLjpxoJ9dB8GQEr6J7U0D8kNzC3-p0nH/exec';

    let loading_global = document.querySelector('.loading-div');

    document.querySelector(formID).addEventListener('submit', async (event) => {
        if (needFormValidation.isValid == false) {
            return false;
        }

        event.preventDefault();

        loading_global.classList.add('active');

        let formData = new FormData(event.target);

        let firstName;
        let lastName;

        if (formData.has('lfullname') || formData.has('lfirstname')) {

            let lfullName = formData.get('lfullname');
            if (lfullName) {
                let fullName = formData.get('lfullname').split(' ');
                firstName, lastName;
                [firstName, ...lastName] = fullName;
                lastName = lastName.join(' ');
            }
            else {
                firstName = formData.get('lfirstname');
                lastName = formData.get('llastname');
            }

            formData.set('lfirstname', firstName);
            formData.set('llastname', lastName);
        }

        formData.append('lsource', leadSource);
        formData.append('sendurlvalue', window.location.href);

        let myHeaders = new Headers();
        myHeaders.append('Content-Type', 'application/json');

        // Initiate the Sales IQ visitor data
		if (window.$zoho && window.$zoho.salesiq) {
			try {
				$zoho.salesiq.visitor.uniqueid();
                if (formData.has('lfullname') || formData.has('lfirstname')) {
                    $zoho.salesiq.visitor.name(firstName + ' ' + lastName);
                }
				$zoho.salesiq.visitor.email(formData.get('lemail'));
				console.log('SalesIQ Name/Email set');
			} catch (error) {
				console.warn('SalesIQ Error:', error);
			}
		}

        let raw = {
            firstName: formData.get('lfirstname'),
            lastName: formData.get('llastname'),
            email: formData.get('lemail'),
            phone: formData.get('lphone'),
            jobTitle: formData.get('ljobtitle'),
            country: formData.get('lcountry'),
            company: formData.get('lcompany'),
            description: formData.get('Description'),
            leadSource: formData.get('lsource'),
            websiteVisitURL: window.location.href,
        };

        Object.keys(raw).forEach(key => {
            if (raw[key] === null || raw[key] === "") {
                delete raw[key];
            }
        });

        raw = JSON.stringify(raw);

        let requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow',
        };
        let googleRequestOptions = {
            method: 'GET',
            redirect: 'follow',
        };
        let request = '?';
        [...formData].forEach(([key, value], index) => {
            request += `${index === 0 ? '' : '&'}${key + '=' + value}`;
        });

        // Request 1: Main Backend
		const backendRequest = fetch(
			'https://us-west1-zoho-crm-scripts.cloudfunctions.net/queueLeadHttp',
			requestOptions,
		);

		// Request 2: Update the Google Sheet Data
		const googleRequest = fetch(
			GoogleSendURL + request,
			googleRequestOptions,
		);

		// Waiting until these request get's completed
		try {
			await Promise.allSettled([backendRequest, googleRequest]);
		} catch (e) {
			console.error('API Error', e);
		}

		// Redirect
		window.location.href = `https://gardenbaskethubb.com/${redirectionLocation}`;
    });
};