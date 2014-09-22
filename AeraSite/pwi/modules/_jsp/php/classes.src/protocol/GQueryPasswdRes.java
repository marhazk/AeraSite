/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GQueryPasswdRes extends Rpc.Data
/*    */ {
/*    */   public int retcode;
/*    */   public int userid;
/*    */   public Octets response;
/*    */ 
/*    */   public GQueryPasswdRes()
/*    */   {
/* 16 */     this.response = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.retcode);
/* 22 */     os.marshal(this.userid);
/* 23 */     os.marshal(this.response);
/* 24 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 29 */     this.retcode = os.unmarshal_int();
/* 30 */     this.userid = os.unmarshal_int();
/* 31 */     os.unmarshal(this.response);
/* 32 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 39 */       GQueryPasswdRes o = (GQueryPasswdRes)super.clone();
/* 40 */       o.response = ((Octets)this.response.clone());
/* 41 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 44 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GQueryPasswdRes
 * JD-Core Version:    0.6.2
 */