/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GMGetGameAttriRes extends Rpc.Data
/*    */ {
/*    */   public Octets value;
/*    */ 
/*    */   public GMGetGameAttriRes()
/*    */   {
/* 14 */     this.value = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 19 */     os.marshal(this.value);
/* 20 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 25 */     os.unmarshal(this.value);
/* 26 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 33 */       GMGetGameAttriRes o = (GMGetGameAttriRes)super.clone();
/* 34 */       o.value = ((Octets)this.value.clone());
/* 35 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 38 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMGetGameAttriRes
 * JD-Core Version:    0.6.2
 */