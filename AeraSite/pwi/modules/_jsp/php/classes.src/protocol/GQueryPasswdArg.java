/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GQueryPasswdArg extends Rpc.Data
/*    */ {
/*    */   public Octets account;
/*    */   public Octets challenge;
/*    */   public int loginip;
/*    */ 
/*    */   public GQueryPasswdArg()
/*    */   {
/* 16 */     this.account = new Octets();
/* 17 */     this.challenge = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.account);
/* 23 */     os.marshal(this.challenge);
/* 24 */     os.marshal(this.loginip);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     os.unmarshal(this.account);
/* 31 */     os.unmarshal(this.challenge);
/* 32 */     this.loginip = os.unmarshal_int();
/* 33 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 40 */       GQueryPasswdArg o = (GQueryPasswdArg)super.clone();
/* 41 */       o.account = ((Octets)this.account.clone());
/* 42 */       o.challenge = ((Octets)this.challenge.clone());
/* 43 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 46 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GQueryPasswdArg
 * JD-Core Version:    0.6.2
 */