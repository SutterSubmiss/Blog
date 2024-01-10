describe('Test lajkonika',()=>{
    beforeEach(()=>{
        cy.visit("https://technikium.wsi.edu.pl/")
    })
    it("sprawdzenie czy strona jestw UTF-8",()=>{
       cy.document().should('have.property','charset').and('eq','UTF-8')

    })
    it("Czy pojawia sie komunikat cookies",()=>{

        cy.get('.cookies-notice-container')
             .should('have.length',1);
        cy.get('#cn-accept-cookie')
           .click();
        cy.get('.cookies-notice-container')
           .should('not.have.css','display',none);
    

    })

})