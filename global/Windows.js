

/* ========================================================================= */
/* Show Date Window     													 */
/* ========================================================================= */
	function gf_ShowDate(mOutBox) {
		window.open('js/GetDate.asp?ELEMENT='+mOutBox, '_new', 'toolbar=no, resizable=no, height=310px, width=300px')
	}








/* ========================================================================= */
/* Show Admitted Patients													 */   
/* ========================================================================= */
function showLookupAP(mSrc, mFilter, mPType) {
	window.open('showAdmittedPatients.asp?Src='+mSrc+'&Filter='+mFilter+'&PType='+mPType, 
									'_new', 'toolbar=no', 'scrolbar=no')
}
