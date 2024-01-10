describe("Test systemu Dzwon",()=>{
    beforeEach(()=>{
        cy.visit('https://10.10.1.2:81')
    })
    if("Testowanie ręcznego sterowania dzwonkiem",()=>{
  let status = "";
    cy.get('.alarmdisable')
        .invoke('text')
        .then(text=>{
          cy.log(text);
          console.log(text);
          status = text;
        })
         if(text == 'ON'){
         cy.get('alarmdisable')
               .click()
               .wait(1000)
               .should('have.class','btn-danger')
                        .and('text','OFF')
         }
        })
   
       
   
    cy.wait(1000);
    //console.log(alarm);
   
})