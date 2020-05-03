function checkForCookieAgreement()
{
	let name = 'cookieAgreement='
	let decodedCookieString = decodeURIComponent(document.cookie);
	let cookieArray = decodedCookieString.split(';');

	for (let i = 0; i < cookieArray.length; ++i)
	{
		let cookie = cookieArray[i];

		while (cookie.charAt(0) == ' ')
		{
			cookie = cookie.substring(1);
		}
		
		if (cookie.indexOf(name) == 0)
		{
			return true;
		}
	}
	return false;
}

function fadeInAgreementPrompt()
{
	let agreementPrompt = document.getElementById("cookies");
	agreementPrompt.style.display = 'block';
	agreementPrompt.style.opacity = '1';
}

function checkAndShowPrompt()
{
	if (!checkForCookieAgreement())
	{
		fadeInAgreementPrompt();
	}
}

function fadeOutAgreementPrompt()
{
	let agreementPrompt = document.getElementById("cookies");
	agreementPrompt.style.opacity = '0';
	window.setTimeout(function(){agreementPrompt.style.display = 'none';}, 500);
}

function setCookie()
{
	document.cookie = 'cookieAgreement=true';
}

function setAndHidePrompt()
{
	setCookie();
	fadeOutAgreementPrompt();
}